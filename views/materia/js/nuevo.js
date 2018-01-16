/**
 * Created by lilsa on 04/05/2017.
 */
$(document).ready(function () {
    $('#frmAddMateria').validate({
        rules:{
            mPeso:{
                required:true
            },
            mCepa:{
                required:true
            },
            mHojas:{
                required:true
            },
            mTierra:{
                required:true
            },
            mRaices:{
                required:true
            }
        },
        messages:{
            mPeso:{
                required:"Peso es obligatorio"
            },
            mCepa:{
                required:"Cepa es requerido"
            },
            mHojas:{
                required:"Hojas es requerido"
            },
            mTierra:{
                required:"Tierra es requerido"
            },
            mRaices:{
                required:"Raices es requerido"
            }
        }
    });
});