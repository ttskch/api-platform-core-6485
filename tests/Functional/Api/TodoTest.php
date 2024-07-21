<?php

declare(strict_types=1);

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Subtask;
use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;

class TodoTest extends ApiTestCase
{
    protected function setUp(): void
    {
        $todo = (new Todo())
            ->setTitle('todo1')
            ->setDone(false)
            ->addSubtask((new Subtask())->setTitle('subtask1')->setDone(false))
            ->addSubtask((new Subtask())->setTitle('subtask2')->setDone(false))
            ->addSubtask((new Subtask())->setTitle('subtask3')->setDone(false))
        ;

        $em = self::getContainer()->get(EntityManagerInterface::class);
        assert($em instanceof EntityManagerInterface);
        $em->persist($todo);
        $em->flush();
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/api/todos/1');

        self::assertJsonEquals([
            '@context' => '/api/contexts/Todo',
            '@id' => '/api/todos/1',
            '@type' => 'Todo',
            'id' => 1,
            'title' => 'todo1',
            'done' => false,
            'subtasks' => [
                [
                    '@type' => 'Subtask',
                    'done' => false,
                    'id' => 1,
                    'title' => 'subtask1',
                    'todo' => '/api/todos/1'
                ],
                [
                    '@type' => 'Subtask',
                    'done' => false,
                    'id' => 2,
                    'title' => 'subtask2',
                    'todo' => '/api/todos/1'
                ],
                [
                    '@type' => 'Subtask',
                    'done' => false,
                    'id' => 3,
                    'title' => 'subtask3',
                    'todo' => '/api/todos/1'
                ],
            ],
        ]);

        self::assertMatchesResourceItemJsonSchema(Todo::class);
    }
}
