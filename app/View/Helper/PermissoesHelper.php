<?php

class PermissoesHelper extends AppHelper 
{
    public function usuario_possui_permissao_para($modulo_requisitado, $acesso_requisitado)
    {
        if ($acesso_requisitado != 'read' && $acesso_requisitado != 'write') {
            return false;
        }

        if (!$this->usuarioNaoESubUsuario()) {
            return true;
        }

        foreach ($GLOBALS['modulos'] as $modulo) {
            if ($modulo['modulo'] == $modulo_requisitado) {
                if (in_array($acesso_requisitado, $modulo['permissao'])) {
                    return true;
                }
            }
        }
        
        return false;
    }

    public function usuarioNaoESubUsuario() 
    {
        return $this->subusuario === null;
    }
}
