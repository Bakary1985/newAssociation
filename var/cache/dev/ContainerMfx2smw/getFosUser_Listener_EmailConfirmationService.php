<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'fos_user.listener.email_confirmation' shared service.

return $this->services['fos_user.listener.email_confirmation'] = new \FOS\UserBundle\EventListener\EmailConfirmationListener(${($_ = isset($this->services['fos_user.mailer']) ? $this->services['fos_user.mailer'] : $this->load('getFosUser_MailerService.php')) && false ?: '_'}, ${($_ = isset($this->services['fos_user.util.token_generator']) ? $this->services['fos_user.util.token_generator'] : $this->services['fos_user.util.token_generator'] = new \FOS\UserBundle\Util\TokenGenerator()) && false ?: '_'}, ${($_ = isset($this->services['router']) ? $this->services['router'] : $this->getRouterService()) && false ?: '_'}, ${($_ = isset($this->services['session']) ? $this->services['session'] : $this->load('getSessionService.php')) && false ?: '_'});
