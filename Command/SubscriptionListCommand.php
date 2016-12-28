<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Beyerz\CheckBookIOBundle\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SubscriptionListCommand extends ContainerAwareCommand
{

    protected function configure(){
        $this->setName('checkbook:subscription:list')
            ->setDescription("List your subscriptions")
            ->addOption('access_token', 'a', InputOption::VALUE_OPTIONAL, "If querying on behalf of a user with Oauth, provide the access_token",null)
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used list all the subscriptions under you account
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output){
        $io = new SymfonyStyle($input, $output);
        $io->title("Invoice List");
        $checkBook = $this->getContainer()->get('checkbook.model');

        if(is_null($input->getOption('access_token'))) {
            $list = $checkBook->subscription()->listAll();
        }else{
            $oauth = new Oauth();
            $oauth->setAccessToken($input->getOption('access_token'));
            $list = $checkBook->oauth()->subscription($oauth)->listAll();
        }


        $headers = [];
        $serialized = [];
        /** @var Subscription $ch */
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