<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * Controller is a simple implementation of a Controller.
 *
 * It provides methods to common features needed in controllers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Controller extends ContainerAware
{
    /**
     * Generates a URL from the given parameters.
     *
     * @param string      $route         The name of the route
     * @param mixed       $parameters    An array of parameters
     * @param bool|string $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    public function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->container->get('router')->generate($route, $parameters, $referenceType);
    }

    /**
     * Forwards the request to another controller.
     *
     * @param string $controller The controller name (a string like BlogBundle:Post:index)
     * @param array  $path       An array of path parameters
     * @param array  $query      An array of query parameters
     *
     * @return Response A Response instance
     */
    public function forward($controller, array $path = array(), array $query = array())
    {
        $path['_controller'] = $controller;
        $subRequest = $this->container->get('request_stack')->getCurrentRequest()->duplicate($query, null, $path);

        return $this->container->get('http_kernel')->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
    }

    /**
     * Returns a RedirectResponse to the given URL.
     *
     * @param string $url    The URL to redirect to
     * @param int    $status The status code to use for the Response
     *
     * @return RedirectResponse
     */
    public function redirect($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
    }

    /**
     * Returns a RedirectResponse to the given route with the given parameters.
     *
     * @param string $route      The name of the route
     * @param array  $parameters An array of parameters
     * @param int    $status     The status code to use for the Response
     *
     * @return RedirectResponse
     */
    protected function redirectToRoute($route, array $parameters = array(), $status = 302)
    {
        return $this->redirect($this->generateUrl($route, $parameters), $status);
    }

    /**
     * Adds a flash message to the current session for type.
     *
     * @param string $type    The type
     * @param string $message The message
     *
     * @throws \LogicException
     */
    protected function addFlash($type, $message)
    {
        if (!$this->container->has('session')) {
            throw new \LogicException('You can not use the addFlash method if sessions are disabled.');
        }

        $this->container->get('session')->getFlashBag()->add($type, $message);
    }

    /**
     * Checks if the attributes are granted against the current authentication token and optionally supplied object.
     *
     * @param mixed $attributes The attributes
     * @param mixed $object     The object
     *
     * @throws \LogicException
     *
     * @return bool
     */
    protected function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

    /**
     * Throws an exception unless the attributes are granted against the current authentication token and optionally
     * supplied object.
     *
     * @param mixed  $attributes The attributes
     * @param mixed  $object     The object
     * @param string $message    The message passed to the exception
     *
     * @throws AccessDeniedException
     */
    protected function denyAccessUnlessGranted($attributes, $object = null, $message = 'Access Denied.')
    {
        if (!$this->isGranted($attributes, $object)) {
            throw $this->createAccessDeniedException($message);
        }
    }

    /**
     * Returns a rendered view.
     *
     * @param string $view       The view name
     * @param array  $parameters An array of parameters to pass to the view
     *
     * @return string The rendered view
     */
    public function renderView($view, array $parameters = array())
    {
        return $this->container->get('templating')->render($view, $parameters);
    }

    /**
     * Renders a view.
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A response instance
     *
     * @return Response A Response instance
     */
    public function render($view, array $parameters = array(), Response $response = null)
    {
        return $this->container->get('templating')->renderResponse($view, $parameters, $response);
    }

    /**
     * Streams a view.
     *
     * @param string           $view       The view name
     * @param array            $parameters An array of parameters to pass to the view
     * @param StreamedResponse $response   A response instance
     *
     * @return StreamedResponse A StreamedResponse instance
     */
    public function stream($view, array $parameters = array(), StreamedResponse $response = null)
    {
        $templating = $this->container->get('templating');

        $callback = function () use ($templating, $view, $parameters) {
            $templating->stream($view, $parameters);
        };

        if (null === $response) {
            return new StreamedResponse($callback);
        }

        $response->setCallback($callback);

        return $response;
    }

    /**
     * Returns a NotFoundHttpException.
     *
     * This will result in a 404 response code. Usage example:
     *
     *     throw $this->createNotFoundException('Page not found!');
     *
     * @param string          $message  A message
     * @param \Exception|null $previous The previous exception
     *
     * @return NotFoundHttpException
     */
    public function createNotFoundException($message = 'Not Found', \Exception $previous = null)
    {
        return new NotFoundHttpException($message, $previous);
    }

    /**
     * Returns an AccessDeniedException.
     *
     * This will result in a 403 response code. Usage example:
     *
     *     throw $this->createAccessDeniedException('Unable to access this page!');
     *
     * @param string          $message  A message
     * @param \Exception|null $previous The previous exception
     *
     * @return AccessDeniedException
     */
    public function createAccessDeniedException($message = 'Access Denied', \Exception $previous = null)
    {
        return new AccessDeniedException($message, $previous);
    }

    /**
     * Creates and returns a Form instance from the type of the form.
     *
     * @param string|FormTypeInterface $type    The built type of the form
     * @param mixed                    $data    The initial data for the form
     * @param array                    $options Options for the form
     *
     * @return Form
     */
    public function createForm($type, $data = null, array $options = array())
    {
        return $this->container->get('form.factory')->create($type, $data, $options);
    }

    /**
     * Creates and returns a form builder instance.
     *
     * @param mixed $data    The initial data for the form
     * @param array $options Options for the form
     *
     * @return FormBuilder
     */
    public function createFormBuilder($data = null, array $options = array())
    {
        return $this->container->get('form.factory')->createBuilder('form', $data, $options);
    }

    /**
     * Shortcut to return the request service.
     *
     * @return Request
     *
     * @deprecated since version 2.4, to be removed in 3.0.
     *             Ask Symfony to inject the Request object into your controller
     *             method instead by type hinting it in the method's signature.
     */
    public function getRequest()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 2.4 and will be removed in 3.0. The only reliable way to get the "Request" object is to inject it in the action method.', E_USER_DEPRECATED);

        return $this->container->get('request_stack')->getCurrentRequest();
    }

    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return Registry
     *
     * @throws \LogicException If DoctrineBundle is not available
     */
    public function getDoctrine()
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return $this->container->get('doctrine');
    }

    /**
     * Get a user from the Security Token Storage.
     *
     * @return mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     */
    public function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    /**
     * Returns true if the service id is defined.
     *
     * @param string $id The service id
     *
     * @return bool true if the service id is defined, false otherwise
     */
    public function has($id)
    {
        return $this->container->has($id);
    }

    /**
     * Gets a container service by its id.
     *
     * @param string $id The service id
     *
     * @return object The service
     */
    public function get($id)
    {
        if ('request' === $id) {
            @trigger_error('The "request" service is deprecated and will be removed in 3.0. Add a typehint for Symfony\\Component\\HttpFoundation\\Request to your controller parameters to retrieve the request instead.', E_USER_DEPRECATED);
        }

        return $this->container->get($id);
    }

    /**
     * Gets a container configuration parameter by its name.
     *
     * @param string $name The parameter name
     *
     * @return mixed
     */
    protected function getParameter($name)
    {
        return $this->container->getParameter($name);
    }

    /**
     * Checks the validity of a CSRF token.
     *
     * @param string $id    The id used when generating the token
     * @param string $token The actual token sent with the request that should be validated
     *
     * @return bool
     */
    protected function isCsrfTokenValid($id, $token)
    {
        if (!$this->container->has('security.csrf.token_manager')) {
            throw new \LogicException('CSRF protection is not enabled in your application.');
        }

        return $this->container->get('security.csrf.token_manager')->isTokenValid(new CsrfToken($id, $token));
    }

    public function explode_date($raw_date)
    {
        $date_chunk = array();
        $date_chunk = explode("-", trim($raw_date));
        return $date_chunk;
    }
    public function convert_date_format($date)
    {
        $parts=explode("/", $date);
        $d = trim($parts[0]);
        $m = trim($parts[1]);
        $y = trim($parts[2]);

        $convert = $y."-".$m."-".$d;

        return $convert;
    }

    public function getCompanyAxesEvaluation($company){
        $query = "select r.id, r.nom, sum(b.capacity) as place, t.upPrice,  (t.upPrice * sum(b.capacity)) as profit from travel t
                    left join route r on r.id = t.route_id
                    left join bus b on b.id = t.bus_id

                    where b.company_id = $company
                    group by r.nom";

        $total = $this->getDoctrine()->getConnection()->prepare($query);
        $total->execute();
        $results = $total->fetchAll();
        // echo $date; exit;
        return $results;
    }

    public function getCompanyBestAxes($company, $from, $to){

        $query = "select r.id, r.nom,
                    count(case when rv.date_add between '$from 00:00:00' and '$to 23:59:59' then tk.id else null end) as total,
                     ( count(case when rv.date_add between '$from 00:00:00' and '$to 23:59:59' then tk.id else null end) * t.upPrice) as solde
                    from travel t
                    left join route r on r.id = t.route_id
                    left join bus b on b.id = t.bus_id
                    left join reservation rv on rv.travel_id = t.id
                    left join reservation_ticket rt on rt.reservation_id = rv.id
                    left join ticket tk on tk.id = rt.ticket_id

                    where b.company_id = $company
                    group by r.nom
                    LIMIT 10";

        $total = $this->getDoctrine()->getConnection()->prepare($query);
        $total->execute();
        $results = $total->fetchAll();
        // echo $date; exit;
        return $results;
    }

    public function getCompanyBestCustomer($company, $from ,$to){
        $query = "select
                 tk.nom,
                tk.telephone,
                count( tk.id)  as total,
                ( count(tk.id ) * t.upPrice) as spent
                 from ticket tk
                left join reservation_ticket rt on rt.ticket_id = tk.id
                left join reservation r on r.id = rt.reservation_id
                left join travel t on t.id = r.travel_id
                left join bus b on t.bus_id = b.id

                where b.company_id = $company and r.date_add between '$from 00:00:00' and '$to 23:59:59'
                group by tk.telephone
                order by total desc; ";

        $total = $this->getDoctrine()->getConnection()->prepare($query);
        $total->execute();
        $results = $total->fetchAll();
        // echo $date; exit;
        return $results;
    }

    public function getCompanyCustomerInfos($company, $from, $to, $route = null){
        if($route == null){
            $query = "select
                 count(case when tk.gender = 'M' then tk.id else null end) as male,
                 count(case when tk.gender = 'F' then tk.id else null end) as female
                from ticket tk
                left join reservation_ticket rt on rt.ticket_id = tk.id
                left join reservation r on r.id = rt.reservation_id
                left join travel t on t.id = r.travel_id
                left join bus b on t.bus_id = b.id

                where b.company_id = $company and r.date_add between '$from 00:00:00' and '$to 23:59:59'
                -- group by tk.telephone";

            $total = $this->getDoctrine()->getConnection()->prepare($query);
            $total->execute();
            $results = $total->fetchAll();
            // echo $date; exit;
            return $results;
        }else{
            $query = "select
                 count(case when tk.gender = 'M' then tk.id else null end) as male,
                 count(case when tk.gender = 'F' then tk.id else null end) as female
                from ticket tk
                left join reservation_ticket rt on rt.ticket_id = tk.id
                left join reservation r on r.id = rt.reservation_id
                left join travel t on t.id = r.travel_id
                left join bus b on t.bus_id = b.id

                where b.company_id = $company and
                t.route_id = $route and
                r.date_add between '$from 00:00:00' and '$to 23:59:59'
                -- group by tk.telephone";

            $total = $this->getDoctrine()->getConnection()->prepare($query);
            $total->execute();
            $results = $total->fetchAll();
            // echo $date; exit;
            return $results;

        }
    }

    public function getCompanyCustomerAgeGroup($company, $from, $to, $route = null){
        if($route == null){
            $query = "select
                  count(case when tk.age < 19
                        then tk.id else null end) as 'lessthan19',
                count(case when tk.age BETWEEN 20 AND 30
                        then tk.id else null end) as '2030',
                count(case when tk.age BETWEEN 31 AND 39
                        then tk.id else null end) as '3139',
                count(case when tk.age BETWEEN 40 AND 49
                        then tk.id else null end) as '4049',
                count(case when tk.age > 50
                       then tk.id else null end) as 'morethan50',
                count(case when tk.age is null
                     then tk.id else null end) as 'Unknown'


                from ticket tk
                left join reservation_ticket rt on rt.ticket_id = tk.id
                left join reservation r on r.id = rt.reservation_id
                left join travel t on t.id = r.travel_id
                left join bus b on t.bus_id = b.id

                where b.company_id = $company and r.date_add between '$from 00:00:00' and '$to 23:59:59'
                ";

            $total = $this->getDoctrine()->getConnection()->prepare($query);
            $total->execute();
            $results = $total->fetchAll();
            // echo $date; exit;
            return $results;
        }else{
            $query = "select
                  count(case when tk.age < 19
                        then tk.id else null end) as 'lessthan19',
                count(case when tk.age BETWEEN 20 AND 30
                        then tk.id else null end) as '2030',
                count(case when tk.age BETWEEN 31 AND 39
                        then tk.id else null end) as '3139',
                count(case when tk.age BETWEEN 40 AND 49
                        then tk.id else null end) as '4049',
                count(case when tk.age > 50
                       then tk.id else null end) as 'morethan50',
                count(case when tk.age is null
                     then tk.id else null end) as 'Unknown'


                from ticket tk
                left join reservation_ticket rt on rt.ticket_id = tk.id
                left join reservation r on r.id = rt.reservation_id
                left join travel t on t.id = r.travel_id
                left join bus b on t.bus_id = b.id

                where b.company_id = $company and
                 t.route_id = $route and
                 r.date_add between '$from 00:00:00' and '$to 23:59:59'
                ";

            $total = $this->getDoctrine()->getConnection()->prepare($query);
            $total->execute();
            $results = $total->fetchAll();
            // echo $date; exit;
            return $results;
        }
    }



}
