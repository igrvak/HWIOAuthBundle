<?php
namespace Iwin\Bundle\AppBundle\Service\Twig;

use Iwin\Bundle\AppBundle\Service\Util\FileUrlManager;
use Iwin\Bundle\SharedBundle\Entity\File;
use Symfony\Component\HttpFoundation\Request;
use Werkint\Bundle\FrameworkExtraBundle\Twig\AbstractExtension;

/**
 * Основное TWIG-расширение
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class IwinAppExtension extends AbstractExtension
{
    protected $vars;
    protected $locales;
    protected $request;
    protected $fileUrlManager;
    protected $globals;

    const EXT_NAME = 'iwin_app';

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        $this->vars += [
            'langlinks' => $this->getLangPaths(),
        ];
        $this->globals = [
            'var' => $this->vars,
        ];

        $this->addFunction('file_url', false, function (File $file) {
            return $this->fileUrlManager->getUrl($file);
        });
    }

    /**
     * @param array        $vars
     * @param Request|null $request
     * @param array        $locales
     */
    public function __construct(
        array $vars,
        Request $request = null,
        array $locales,
        FileUrlManager $fileUrlManager
    ) {
        $this->fileUrlManager = $fileUrlManager;
        $this->request = $request;
        $this->locales = $locales;
        $this->vars = $vars['params'];

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(
        \Twig_Environment $env
    ) {
        $this->globals['macros'] = $env->loadTemplate('::twig/macros.twig');
    }

    /**
     * @return string[]
     */
    protected function getLangPaths()
    {
        if (!$this->request) {
            return [];
        }
        $langPath = substr($this->request->getRequestUri(), 4);
        $langPath = $this->request->getScheme() . '://' . $this->request->getHttpHost() . '/%s/' . str_replace('%', '%%', $langPath);
        $langs = [];
        foreach ($this->locales as $lang) {
            $langs[$lang] = sprintf($langPath, $lang);
        }

        return $langs;
    }
}
