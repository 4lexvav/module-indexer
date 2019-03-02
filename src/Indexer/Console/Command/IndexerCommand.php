<?php

namespace Vav\Indexer\Console\Command;

use Magento\Framework\App\State as AppState;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vav\Indexer\Api\Service\IndexerServiceInterface;

class IndexerCommand extends Command
{
    const INPUT_KEY_PRODUCTS = 'products';

    /**
     * @var AppState
     */
    private $appState;
    /**
     * @var IndexerServiceInterface
     */
    private $indexerService;

    public function __construct(
        IndexerServiceInterface $indexerService,
        AppState $appState
    ) {
        $this->indexerService = $indexerService;
        $this->appState = $appState;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('4lexvav:indexer')
            ->setDescription('Run partial reindex for specified products only.')
            ->setDefinition([
                new InputArgument(
                    self::INPUT_KEY_PRODUCTS,
                    InputArgument::REQUIRED | InputArgument::IS_ARRAY,
                    'Space-separated list of products IDs to reindex.'
                )
            ]);

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*try {
            $this->appState->setAreaCode('global');
        } catch (\Exception $e) {
            # already set by another module
        }*/

        $this->indexerService->reindex($input->getArgument(self::INPUT_KEY_PRODUCTS));

        $output->writeln('Indexation completed');
    }
}
