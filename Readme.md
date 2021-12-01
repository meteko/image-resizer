# Neos CMS Image Resizer

On upload, the uploaded asset will be replaced, with a resized version.

## Installation

`composer require meteko/image-resizer`

## Configuration

The configuration is possible with the same values from `ThumbnailConfiguration` [(see code)](https://github.com/neos/media/blob/master/Classes/Domain/Model/ThumbnailConfiguration.php) used for ThumbnailPresets.

## Example

To automatically resize to a maximum width of 1024 and maximum height of 800, the configuration is this

```
Meteko:
  ImageResizer:
    configuration:
      maximumWidth: 1024
      maximumHeight: 800
```

## Support

Free support in the [Neos Slack channel](http://slack.neos.io/) and bug/features via the **Issues** and **Merge request** feature ohere on Github!

## Do you want to create great things, together?

Meteko is a web agency creating online solutions and great user experiences.

We love making the complex, user friendly.