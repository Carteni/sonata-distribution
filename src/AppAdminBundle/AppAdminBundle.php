<?php

namespace AppAdminBundle;

use AppAdminBundle\DependencyInjection\Compiler\SonataMediaCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppAdminBundle extends Bundle
{
	public function build(ContainerBuilder $containerBuilder)
	{
		$containerBuilder->addCompilerPass(new SonataMediaCompilerPass());
	}
}
