<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


use Doctrine\DBAL\Schema\Comparator;
use Doctrine\ORM\Tools\SchemaTool;

class MyCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('app:my')
			->setDescription('Test')
			/*->addArgument(
			)
			->addOption(
			)*/
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');

		/* Doctrine tool class for create/drop/update database schemas
		based on metadata class descriptors */
		$tool = new SchemaTool($em);

		/* Doctrine tool class for comparing differences between database
		schemas */
		$comparator = new Comparator();

		/* Create an empty schema */
		$fromSchema = $tool->getSchemaFromMetadata(array());

		/* Create the schema for our class */
		$toSchema = $tool->getSchemaFromMetadata(
			array($em->getClassMetadata('AppBundle:Bibliotheque'))
		);

		/* Compare schemas, and write result as SQL */
		$schemaDiff = $comparator->compare($fromSchema, $toSchema);
		$sql = $toSchema->toSql(
			$em->getConnection()->getDatabasePlatform()
		);
		/*
		$sql = $schemaDiff->toSql(
			$em->getConnection()->getDatabasePlatform()
		);*/
		$output->writeln($sql);
	}
}