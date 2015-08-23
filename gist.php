<?php

use Herbie\DI;
use Herbie\Hook;

class GistPlugin
{

    /**
     * Initialize plugin
     */
    public static function install()
    {
        $config = DI::get('Config');
        if ((bool)$config->get('plugins.config.gist.twig', false)) {
            Hook::attach('twigInitialized', ['GistPlugin', 'addTwigFunction']);
        }
        if ((bool)$config->get('plugins.config.gist.shortcode', true)) {
            Hook::attach('shortcodeInitialized', ['GistPlugin', 'addShortcode']);
        }
    }


    public static function addTwigFunction($twig)
    {
        $twig->addFunction(
            new Twig_SimpleFunction('gist', ['GistPlugin', 'gistTwig'], ['is_safe' => ['html']])
        );
    }

    public static function addShortcode($shortcode)
    {
        $shortcode->add('gist', ['GistPlugin', 'gistShortcode']);
    }

    /**
     * @param string $id
     * @param string $file
     * @return string
     */
    public static function gistTwig($id, $file = '')
    {
        return "<script src=\"http://gist.github.com/{$id}.js" . ($file == '' ? '' : '?file=' . $file) . "\"></script>";
    }

    /**
     * @param array $options
     * @return string
     */
    public static function gistShortcode($options)
    {
        $options = array_merge([
            'id' => empty($options[0]) ? '' : $options[0],
            'file' => ''
        ], $options);
        return call_user_func_array(['GistPlugin', 'gistTwig'], $options);
    }

}

GistPlugin::install();
