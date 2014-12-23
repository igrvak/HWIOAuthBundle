<?php
namespace Iwin\Bundle\AppBundle\Service\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Werkint\Bundle\FrameworkExtraBundle\Twig\AbstractExtension;

/**
 * Основное TWIG-расширение
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class IwinAppExtension extends AbstractExtension
{
    const EXT_NAME = 'iwin_app';

    protected function init()
    {
        // TODO: write
    }

    /**
     * @param ContainerInterface $cont
     */
    public function __construct(
        ContainerInterface $cont
    ) {
        $this->globals = [
            'var' => [
                'title'           => $cont->getParameter('app.title'),
                'langs'           => $cont->getParameter('locales_supported'),
                'localeIsDefault' => $cont->isScopeActive('request') ?
                        $cont->get('request')->getLocale() === $cont->getParameter('kernel.default_locale') :
                        $cont->getParameter('locale') === $cont->getParameter('kernel.default_locale'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(
        \Twig_Environment $env
    ) {
        $this->globals['macros'] = $env->loadTemplate('::twig/macros.twig');
    }
}
