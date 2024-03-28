<?php
if (isset($datos['alertas'])) :
                if (count($datos['alertas']) > 0) :
                    echo "<div class='alert alert-danger bg-white mx-auto mt-5'>";
                    foreach ($datos['alertas'] as $alerta) :
                        echo "<strong> " . $alerta . "</strong><br/>";
                    endforeach;
                    echo "</div>";
                    echo "</div>";
                endif;
            endif;
?>