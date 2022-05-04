<?php

namespace Meteko\ImageResizer;

use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\AssetInterface;
use Neos\Media\Domain\Model\ImageVariant;
use Neos\Media\Domain\Model\ThumbnailConfiguration;
use Neos\Media\Domain\Service\AssetService;
use Neos\Media\Domain\Service\ThumbnailService;
use Neos\Utility\MediaTypes;

/**
 * @Flow\Scope("singleton")
 */
class ImageResizerUtility
{

    /**
     * @Flow\InjectConfiguration("configuration")
     * @var array
     */
    protected $configuration;

    /**
     * @Flow\Inject
     * @var ThumbnailService
     */
    protected $thumbnailService;

    /**
     * @Flow\Inject
     * @var AssetService
     */
    protected $assetService;

    public function resize(AssetInterface $asset)
    {
        if ($asset instanceof ImageVariant) {
            return;
        }

        $configuration = $this->configuration;
        $sourceMediaType = MediaTypes::parseMediaType($asset->getMediaType());

        if ($sourceMediaType['type'] !== 'image' || $configuration === []) {
            return;
        }

        $thumbnailConfiguration = new ThumbnailConfiguration(
            $configuration['width'] ?? null,
            $configuration['maximumWidth'] ?? null,
            $configuration['height'] ?? null,
            $configuration['maximumHeight'] ?? null,
            $configuration['allowCropping'] ?? false,
            $configuration['allowUpScaling'] ?? false,
            false,
            $configuration['quality'] ?? null,
            $configuration['format'] ?? null
        );

        $thumbnail = $this->thumbnailService->getThumbnail($asset, $thumbnailConfiguration);
        $this->assetService->replaceAssetResource($asset, $thumbnail->getResource());
    }
}