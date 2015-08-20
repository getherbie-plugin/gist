<?php

/**
 * This file is part of Herbie.
 *
 * (c) Thomas Breuss <www.tebe.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace herbie\plugin\gist;

use Herbie;
use Twig_SimpleFunction;

class GistPlugin extends Herbie\Plugin
{
    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        $events = [];
        if ((bool)$this->config('plugins.config.gist.twig', false)) {
            $events[] = 'onTwigInitialized';
        }
        if ((bool)$this->config('plugins.config.gist.shortcode', true)) {
            $events[] = 'onShortcodeInitialized';
        }
        return $events;
    }

    public function onTwigInitialized($twig)
    {
        $twig->addFunction(
            new Twig_SimpleFunction('gist', [$this, 'gistTwig'], ['is_safe' => ['html']])
        );
    }

    public function onShortcodeInitialized($shortcode)
    {
        $shortcode->add('gist', [$this, 'gistShortcode']);
    }

    /**
     * @param string $id
     * @param string $file
     * @return string
     */
    public function gistTwig($id, $file = '')
    {
        return "<script src=\"http://gist.github.com/{$id}.js" . ($file == '' ? '' : '?file=' . $file) . "\"></script>";
    }

    /**
     * @param array $options
     * @return string
     */
    public function gistShortcode($options)
    {
        $options = $this->initOptions([
            'id' => empty($options[0]) ? '' : $options[0],
            'file' => ''
        ], $options);
        return call_user_func_array([$this, 'gistTwig'], $options);
    }

}
