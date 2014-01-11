<?php

/*
 * This file is part of the Fossil project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Fossil\Factory;

use Gnugat\Fossil\Model\Documentation;
use Gnugat\Fossil\Model\Project;
use Gnugat\Fossil\Model\Skeleton;
use Symfony\Component\Filesystem\Filesystem;
use Twig_Environment;

/**
 * Creates the project's documentation files using skeleton files.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class DocumentationFactory
{
    /** @var Twig_Environment */
    private $twig;

    /** @var Filesystem */
    private $filesystem;

    /**
     * @param Twig_Environment $twig
     * @param Filesystem       $filesystem
     */
    public function __construct(Twig_Environment $twig, Filesystem $filesystem)
    {
        $this->twig = $twig;
        $this->filesystem = $filesystem;
    }

    /**
     * @param Skeleton $skeleton
     * @param Project  $project
     *
     * @return Documentation
     */
    public function make(Skeleton $skeleton, Project $project)
    {
        $pathPieces[] = $project->path;
        if ($project->is_bundle() && $skeleton->isInsideDocumentationDirectory()) {
            $pathPieces[] = 'Resources';
        }
        $pathPieces[] = str_replace('.twig', '', $skeleton->relative_pathname);
        $absolutePathname = implode('/', $pathPieces);

        $viewParameters = array('project' => $project);
        $content = $this->twig->render($skeleton->relative_pathname, $viewParameters);

        return new Documentation($this->filesystem, $absolutePathname, $content);
    }
}
