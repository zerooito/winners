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
 * Class with a main method to illustrate the usage of the domain class PagSeguroAuthorizationRequest
 */
class CreateAuthorization
{

    /**
     *
     */
    public static function main()
    {
        // Instantiate a new authorization request
        $authorizationRequest = new PagSeguroAuthorizationRequest();

        $authorizationRequest->setReference('REF123');

        $authorizationRequest->setRedirectURL(
            'http://www.lojamodelo.com.br');

        $authorizationRequest->setNotificationURL(
            'http://www.lojamodelo.com.br');

        /**
         * @enum "CREATE_CHECKOUTS",
         * @enum "RECEIVE_TRANSACTION_NOTIFICATIONS",
         * @enum "SEARCH_TRANSACTIONS",
         * @enum "MANAGE_PAYMENT_PRE_APPROVALS",
         * @enum "DIRECT_PAYMENT",
         * @enum "REFUND_TRANSACTIONS",
         * @enum "CANCEL_TRANSACTIONS"

         */
        $authorizationRequest->setPermissions(
            array(
                "CREATE_CHECKOUTS",
                "RECEIVE_TRANSACTION_NOTIFICATIONS",
                "SEARCH_TRANSACTIONS",
                "MANAGE_PAYMENT_PRE_APPROVALS",
                "DIRECT_PAYMENT",
                "REFUND_TRANSACTIONS",
                "CANCEL_TRANSACTIONS"
            )
        );

        try {
            /**
             * #### Credentials #####
             * Replace the parameters below with your credentials
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getApplicationCredentials();
             */
            $credentials = new PagSeguroApplicationCredentials("appId",
                "appKey");

            // Register this payment request in PagSeguro to obtain the payment URL to redirect your customer.
            $return = $authorizationRequest->register($credentials);

            self::printAuthorizationReturn($return);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printAuthorizationReturn($authorization)
    {

        if ($authorization) {
            echo "<h2>Retorno da requisição de Autorização</h2>";

            if(filter_var($authorization, FILTER_VALIDATE_URL)) {

                echo "<p><strong>URL: </strong>" . $authorization . "</p> ";
                echo "<p><a title=\"URL do pagamento\" href=\"$authorization\">" . "Ir para URL de autorização" . "</a></p>";
            } else {

                echo "<p><strong>Code: </strong>" . $authorization . "</p> ";
            }
        }
    }
}

CreateAuthorization::main();