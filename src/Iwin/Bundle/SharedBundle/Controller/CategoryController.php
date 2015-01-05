<?php
namespace Iwin\Bundle\SharedBundle\Controller;

use Entity\Repository\CategoryRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Iwin\Bundle\SharedBundle\Entity\Category;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Возвращает категории
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @Rest\Route("/categoryapi")
 */
class CategoryController extends Controller
{
    /**
     * @DI\Inject("iwin_shared.repo.category")
     * @var CategoryRepository
     */
    private $repoCategory;

    // -- Actions ---------------------------------------

    /**
     * @Rest\Get("/list.json", name="iwin_shared_category_root", defaults={"_format": "json"})
     * @Rest\Get("/list/{category}.json", name="iwin_shared_category_list", defaults={"_format": "json"})
     * @Rest\View()
     */
    public function listAction(Category $category = null)
    {
        return $category ?
            $category->getChildren() :
            $this->repoCategory->getRootNodes();
    }
}
