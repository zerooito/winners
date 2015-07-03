<?php
/*
 ************************************************************************
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
 ************************************************************************
 */

require_once "../PagSeguroLibrary/PagSeguroLibrary.php";

class SearchAuthorizations
{

    public static function main()
    {

        $options = array(
            'page' => 1, //optional
            'maxPageResults' => 1, //optional
            'initialDate' => '2014-11-23T00:00', //optional
            'finalDate' => '2014-12-02T10:00' //optional
        );

        try {

            /*
             * #### Credentials #####
             * Replace the parameters below with your credentials
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getApplicationCredentials()
             */
            $credentials = new PagSeguroApplicationCredentials("appId",
                "appKey");

            $authorization = PagSeguroAuthorizationSearchService::searchAuthorizations($credentials, $options);

            self::printAuthorization($authorization);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printAuthorization($authorization)
    {
        
        echo "<h2>Authorization search by Reference</h2>";
        echo "<p><strong>" . $authorization->getDate() . "</strong></p>";
        
        if ($authorization->getAuthorizations()) {
            if (is_array($authorization->getAuthorizations())) {
                $i = 0;
                foreach ($authorization->getAuthorizations() as $authorization) {
                    echo "<h2> Authorization: " . ++$i . "</h2>";
                    echo "<p><strong>Code: </strong>" . $authorization->getCode() . "</p>";
                    echo "<p><strong>Creation Date: </strong>" . $authorization->getCreationDate() . "</p>";
                    echo "<p><strong>Reference: </strong>" . $authorization->getReference() . "</p>";
                    echo "<p><strong>PrivateKey: </strong>" .
                        $authorization->getAccount()->getPrivateKey() . "</p>";

                    echo "<h3>Permissions:</h3>";
                    foreach ($authorization->getPermissions()->getPermissions() as $permission) {
                        echo "<p><strong>Code: </strong>" . $permission->getCode() . "</br>";
                        echo "<strong>Status: </strong>" . $permission->getStatus() . "</br>";
                        echo "<strong>Last Update: </strong>" . $permission->getLastUpdate() . "</p>";
                    }
                }
            } else {
                $authorization = $authorization->getAuthorizations();
                echo "<p><strong>Code: </strong>" . $authorization->getCode() . "</p>";
                echo "<p><strong>Creation Date: </strong>" . $authorization->getCreationDate() . "</p>";
                echo "<p><strong>Reference: </strong>" . $authorization->getReference() . "</p>";
                echo "<p><strong>PrivateKey: </strong>" .
                    $authorization->getAccount()->getPrivateKey() . "</p>";

                echo "<h3>Permissions:</h3>";
                foreach ($authorization->getPermissions()->getPermissions() as $permission) {
                    echo "<p><strong>Code: </strong>" . $permission->getCode() . "</br>";
                    echo "<strong>Status: </strong>" . $permission->getStatus() . "</br>";
                    echo "<strong>Last Update: </strong>" . $permission->getLastUpdate() . "</p>";
                }
            }
        } 
        echo "<pre>";
    }
}

SearchAuthorizations::main();