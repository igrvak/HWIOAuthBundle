<?php
namespace {
    use Iwin\Model\AppKernel;
    use Symfony\Bundle\FrameworkBundle\Console\Application;
    use Symfony\Component\Console\Input\ArgvInput;
    use Symfony\Component\Debug\Debug;

    set_time_limit(0);
    define('SYMFONY_ROOT', realpath(__DIR__ . '/..'));
    require_once __DIR__ . '/../bootstrap.php.cache';

    $input = new ArgvInput();
    $env = $input->getParameterOption(['--env', '-e'], getenv('SYMFONY_ENV') ? : 'dev');
    define('SYMFONY_ENV', $env);

    // TODO: проверить безопасность
    //$debug = getenv('SYMFONY_DEBUG') !== '0' && !$input->hasParameterOption(['--no-debug', '']) && explode('_', SYMFONY_ENV)[0] == 'dev';
    Debug::enable();

    $kernel = new AppKernel(SYMFONY_ENV, explode('_', SYMFONY_ENV)[0] == 'dev');

    $application = new Application($kernel);
    $application->run($input);
}
