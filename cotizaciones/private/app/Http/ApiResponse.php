<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:08
 */

namespace App\Http;


class ApiResponse implements \JsonSerializable
{
    private $ok;
    private $message;
    private $data;

    /**Devuelve una respuesta exitosa
     * @param array $data
     * @return ApiResponse
     */
    public static function respuestaExito($data = array())
    {
        $response = new ApiResponse();
        $response->ok = true;
        $response->data = $data;

        return response()->json($response);
    }
    public static function respuestaError($mensaje = "Error")
    {
        $response = new ApiResponse();
        $response->ok = false;
        $response->message = $mensaje;

        return response()->json($response);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            "ok" => $this->ok,
            "message" => $this->message,
            "data"      => $this->data
    ];
    }
}