<?php

namespace BEA\Composer\MakeStablePlugin\Command;

use Composer\Command\BaseCommand;
use Composer\Json\JsonFile;
use JsonSchema\Exception\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeStableCommand extends BaseCommand {

	protected $stable = '*@stable';

	protected function configure() {
		$this->setName( 'make-stable' );
		$this->setDescription( 'Hello, this command allows you to set all your requires to \"*@stable\" version."' );
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$io       = $this->getIO();
		$composer = $this->getComposer();

		// what is the command's purpose
		$output->writeln( "<info>Hello, this command allows you to set all your requires to '* @stable' version</info>" );
		$output->writeln( "<info>Before proceeding please make sure all your requires have the appropriate minimum stability & some releases !</info>" );

		if ( false === $io->askConfirmation(
				"Do you really want to set all requires as \"*@stable\" version ?",
				true ) ) {
			exit;
		}

		$composerPath = $composer->getConfig()->getConfigSource()->getName();
		$composerFile = new JsonFile( $composerPath );
		if ( ! $composerFile->exists() ) {
			$output->writeln( "<error>Composer file not found.</error>" );
			exit;
		}

		// if we cannot write then bail
		if ( ! is_writeable( $composerPath ) ) {
			$output->writeln( "<error>The composer.json file cannot be rewritten !</error>" );
			$output->writeln( "<error>Please check your file permissions.</error>" );
			exit;
		}

		try {
			$composerJson = $composerFile->read();
			if ( isset( $composerJson['require'] ) ) {
				foreach ( $composerJson['require'] as $package => $version ) {
					if ( 'dev-master' === $composerJson['require'][ $package ] ) {
						continue;
					}

					$composerJson['require'][ $package ] = $this->stable;
				}
			}

			if ( isset( $composerJson['require-dev'] ) ) {
				foreach ( $composerJson['require-dev'] as $package => $version ) {
					if ( 'dev-master' === $composerJson['require-dev'][ $package ] ) {
						continue;
					}

					$composerJson['require-dev'][ $package ] = $this->stable;
				}
			}

			$composerFile->write( $composerJson );
			$output->writeln( "All requires are now at \"*@stable\" version \o/" );
		} catch ( RuntimeException $e ) {
			$output->writeln( "<error>An error occurred</error>" );
			$output->writeln( sprintf( "<error>%s</error>", $e->getMessage() ) );
			exit;
		}
	}
}
