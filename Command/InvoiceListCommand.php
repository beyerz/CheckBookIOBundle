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
use Symfony\Component\Console\Style\SymfonyStyle;

class InvoiceListCommand extends ContainerAwareCommand
{

    protected function configure(){
        $this->setName('checkbook:invoice:list')
            ->setDescription("List your invoices")
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used list all the invoices under you account
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output){
        $io = new SymfonyStyle($input, $output);
        $io->title("Invoice List");
        $checkBook = $this->getContainer()->get('checkbook.model');
        $list = $checkBook->invoice()->listAll();
        var_dump($list);
    }
}