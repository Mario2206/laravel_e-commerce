<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\Request;

/**
 * Manage query from request
 *
 * Class QueryManager
 * @package App\Service
 */
class QueryManager
{

    private Request $req;

    public function __construct(Request $req)
    {
        $this->req = $req;
    }

    /**
     * Get value from query (return null if allowed values are provided and not available in query field)
     *
     * @param string $fieldName
     * @param array|null $allowedValues
     * @return string|null
     */
    public function get(string $fieldName, array $allowedValues = null)
    {
        $queries = $this->req->query();

        if(isset($queries[$fieldName])) {

            $value = $queries[$fieldName];

            return !$allowedValues || in_array($value, $allowedValues) ? $value : null;

        }

        return null;
    }

}
