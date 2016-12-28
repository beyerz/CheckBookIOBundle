<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Beyerz\CheckBookIOBundle\Entity\Check;
use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CheckListCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('checkbook:check:list')
            ->setDescription("List your checks")
            ->addOption('access_token', 'a', InputOption::VALUE_OPTIONAL, "If querying on behalf of a user with Oauth, provide the access_token",null)
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used list all the checks under you account
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Checks Listing");
        $checkBook = $this->getContainer()->get('checkbook.model');
        if(is_null($input->getOption('access_token'))) {
            $list = $checkBook->check()->listAll();
        }else{
            $oauth = new Oauth();
            $oauth->setAccessToken($input->getOption('access_token'));
            $list = $checkBook->oauth()->check($oauth)->listAll();
        }

        $headers = [];
        $serialized = [];
        /** @var Check $ch */
        foreach($list as $ch){
            $serialized[] = $ch->serialize();
            if(empty($headers)){
                $headers = array_keys($ch->serialize());
            }
        }
        $io->table($headers, $serialized);
        $io->success('done');
    }
}