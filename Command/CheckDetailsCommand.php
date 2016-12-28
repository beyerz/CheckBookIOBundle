<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CheckDetailsCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('checkbook:check:details')
            ->setDescription("Get the details of an existing check")
            ->addArgument('id', InputOption::VALUE_REQUIRED, 'Check Id')
            ->addOption('access_token', 'a', InputOption::VALUE_OPTIONAL, "If querying on behalf of a user with Oauth, provide the access_token",null)
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used to get the details of an existing check
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Check Details");
        $checkBook = $this->getContainer()->get('checkbook.model');
        if(is_null($input->getOption('access_token'))) {
            $check = $checkBook->check()->details($input->getArgument('id'));
        }else{
            $oauth = new Oauth();
            $oauth->setAccessToken($input->getOption('access_token'));
            $check = $checkBook->oauth()->check($oauth)->details($input->getArgument('id'));
        }

        $headers = array_keys($check->serialize());
        $serialized = $check->serialize();
        $io->table($headers, [$serialized]);
        $io->success('done');
    }
}