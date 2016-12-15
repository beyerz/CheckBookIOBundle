<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CheckListCommand extends ContainerAwareCommand
{

    protected function configure(){
        $this->setName('checkbook:check:list')
            ->setDescription("List your checks")
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used list all the checks under you account
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output){
        $checkBook = $this->getContainer()->get('checkbook.model');
        $list = $checkBook->check()->listAll();
        var_dump($list);
    }
}