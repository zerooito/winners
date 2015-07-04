<?php //

/*
 * ***********************************************************************
 Copyright [2014] [PagSeguro Internet Ltda.]

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 * ***********************************************************************
 */

require_once "../PagSeguroLibrary/PagSeguroLibrary.php";

/**
 * Class with a main method to illustrate the usage of the service PagSeguroRefundService
 */
class CreateRefund
{

    public static function main()
    {

        $transactionCode = "E505C18007B9440D904604D3AE41999A";

        $refundAmount = "1000.00"; //optional

        try {

            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */

            // seller authentication
            $credentials = new PagSeguroAccountCredentials("vendedor@lojamodelo.com.br",
                "E231B2C9BCC8474DA2E260B6C8CF60D3");

            // application authentication
            //$credentials = PagSeguroConfig::getApplicationCredentials();
            //$credentials->setAuthorizationCode("E231B2C9BCC8474DA2E260B6C8CF60D3");

            $refund = PagSeguroRefundService::createRefundRequest($credentials, $transactionCode, $refundAmount);

            self::printRefund($refund);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printRefund($refund)
    {

        if ($refund) {
            echo "<h2>Refund Status:</h2>";
            echo "<p>".$refund ."</p> ";
        }

      echo "<pre>";
    }
}

CreateRefund::main();
