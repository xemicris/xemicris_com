<?php include_once ("header.php"); ?>
<!--toastr-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<main class="main main__calendario">
    <div class="espacio-calendario">
        <div id="calendario"> 
            <div class="encabezado"> 
                <span class="boton boton_izquierdo" id="anterior"> &lang; </span> 
                <span class="asa asa_izquierda"></span> 
                <span class="mes_ano" id="label"></span> 
                <span class="asa asa_derecha"></span> 
                <span class="boton boton_derecho" id="siguiente"> &rang; </span>
            </div> 
            <table id="dias"> 
                <td>Lunes</td> 
                <td>Martes</td> 
                <td>Miércoles</td> 
                <td>Jueves</td> 
                <td>Viernes</td> 
                <td>Sábado</td> 
                <td>Domingo</td>
            </table> 
            <div id="calendario_grid"> 
                <table class="actual"> 
                    <tbody> 
                        <tr>
                            <td class="vacio"></td>
                            <td class="vacio"></td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td></tr><tr>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td></tr><tr>
                            <td>13</td>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td></tr><tr>
                            <td>20</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td></tr><tr>
                            <td>27</td>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td class="vacio"></td>
                            <td class="vacio"></td>
                            <td class="vacio"></td>
                        </tr> 
                    </tbody> 
                </table>
            </div> 
        </div>
    </div>
</main>
<footer>
<?php include_once ("footer.php"); ?>
