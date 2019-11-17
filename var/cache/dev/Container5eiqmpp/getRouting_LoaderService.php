<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'routing.loader' shared service.

$a = ${($_ = isset($this->services['file_locator']) ? $this->services['file_locator'] : $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator(${($_ = isset($this->services['kernel']) ? $this->services['kernel'] : $this->get('kernel', 1)) && false ?: '_'}, ($this->targetDirs[3].'\\app/Resources'), array(0 => ($this->targetDirs[3].'\\app')))) && false ?: '_'};
$b = ${($_ = isset($this->services['annotation_reader']) ? $this->services['annotation_reader'] : $this->getAnnotationReaderService()) && false ?: '_'};
$c = ${($_ = isset($this->services['controller_name_converter']) ? $this->services['controller_name_converter'] : $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(${($_ = isset($this->services['kernel']) ? $this->services['kernel'] : $this->get('kernel', 1)) && false ?: '_'})) && false ?: '_'};

$d = new \FOS\RestBundle\Routing\Loader\RestRouteProcessor();

$e = new \Symfony\Bundle\FrameworkBundle\Routing\AnnotatedRouteControllerLoader($b);

$f = new \Symfony\Component\Config\Loader\LoaderResolver();
$f->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($a));
$f->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($a));
$f->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
$f->addLoader(new \Symfony\Component\Routing\Loader\GlobFileLoader($a));
$f->addLoader(new \Symfony\Component\Routing\Loader\DirectoryLoader($a));
$f->addLoader(new \Symfony\Component\Routing\Loader\DependencyInjection\ServiceRouterLoader($this));
$f->addLoader(${($_ = isset($this->services['sensio_framework_extra.routing.loader.annot_class']) ? $this->services['sensio_framework_extra.routing.loader.annot_class'] : $this->load('getSensioFrameworkExtra_Routing_Loader_AnnotClassService.php')) && false ?: '_'});
$f->addLoader(${($_ = isset($this->services['sensio_framework_extra.routing.loader.annot_dir']) ? $this->services['sensio_framework_extra.routing.loader.annot_dir'] : $this->load('getSensioFrameworkExtra_Routing_Loader_AnnotDirService.php')) && false ?: '_'});
$f->addLoader(${($_ = isset($this->services['sensio_framework_extra.routing.loader.annot_file']) ? $this->services['sensio_framework_extra.routing.loader.annot_file'] : $this->load('getSensioFrameworkExtra_Routing_Loader_AnnotFileService.php')) && false ?: '_'});
$f->addLoader(new \FOS\RestBundle\Routing\Loader\DirectoryRouteLoader($a, $d));
$f->addLoader(new \FOS\RestBundle\Routing\Loader\RestRouteLoader($this, $a, $c, new \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader(new \FOS\RestBundle\Routing\Loader\Reader\RestActionReader($b, ${($_ = isset($this->services['fos_rest.request.param_fetcher.reader']) ? $this->services['fos_rest.request.param_fetcher.reader'] : $this->load('getFosRest_Request_ParamFetcher_ReaderService.php')) && false ?: '_'}, ${($_ = isset($this->services['fos_rest.inflector']) ? $this->services['fos_rest.inflector'] : $this->services['fos_rest.inflector'] = new \FOS\RestBundle\Inflector\DoctrineInflector()) && false ?: '_'}, false, array('json' => false, 'html' => true), true), $b), NULL));
$f->addLoader(new \FOS\RestBundle\Routing\Loader\RestYamlCollectionLoader($a, $d, false, array('json' => false, 'html' => true), NULL));
$f->addLoader(new \FOS\RestBundle\Routing\Loader\RestXmlCollectionLoader($a, $d, false, array('json' => false, 'html' => true), NULL));
$f->addLoader($e);
$f->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $e));
$f->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $e));

return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($c, $f);
