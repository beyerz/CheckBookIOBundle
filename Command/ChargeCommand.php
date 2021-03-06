<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Beyerz\CheckBookIOBundle\Model\Charge\ChargeEntity;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ChargeCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('checkbook:check:charge')
            ->setDescription("Cancel an existing check")
            ->addArgument('token', InputOption::VALUE_REQUIRED, 'Transaction token')
            ->addArgument('amount', InputOption::VALUE_REQUIRED, 'Transaction amount')
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used to charge a check that has been processed by the embedded html form
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Charge Check");
        $checkbook = $this->getContainer()->get('checkbook.model');
        $entity = new ChargeEntity();
        $entity->setAmount($input->getArgument('amount'))
            ->setToken($input->getArgument('token'));
        $charge = $checkbook->charge()->charge($entity);

        $serialized = $charge->serialize();
        $headers = array_keys($serialized);
        $io->table($headers, [$serialized]);
        $io->success('done');
        exit(0);
    }
}