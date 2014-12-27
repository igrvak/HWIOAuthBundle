<?php
namespace Iwin\Bundle\QualBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Iwin\Bundle\QualBundle\Entity\Task;
use Iwin\Bundle\QualBundle\Entity\TaskRepository;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Управление тасками
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @Rest\Route("/taskapi")
 */
class TaskController
{
    /**
     * @DI\Inject("iwin_qual.repo.task")
     * @var TaskRepository
     */
    private $repoTask;
    /**
     * @DI\Inject("jms_serializer")
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @DI\Inject("validator")
     * @var ValidatorInterface
     */
    private $validator;

    // -- Actions ---------------------------------------

    /**
     * @ApiDoc(
     *   description="Создает пустой таск"
     * )
     * @Rest\Get("/", defaults={"_format": "json"})
     * @Rest\View()
     */
    public function createAction()
    {
        return new Task();
    }

    /**
     * @ApiDoc(
     *   description="Возвращает таск"
     * )
     * @Rest\Get("/{task}", defaults={"_format": "json"})
     * @Rest\View()
     */
    public function getAction($task)
    {
        return $this->repoTask->find($task);
    }

    /**
     * @ApiDoc(
     *   description="Создание таска"
     * )
     * @Rest\Post("/", name="iwin_task_save")
     * @Rest\View()
     */
    public function saveAction(Request $req)
    {
        $task = $this->serializer->deserialize(
            $req->getContent(),
            'Iwin\\Bundle\\TaskBundle\\Entity\\Task',
            'json'
        );
        die();
    }
}
