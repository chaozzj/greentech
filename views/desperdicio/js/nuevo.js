/**
 * Created by lilsa on 04/05/2017.
 */
$(document).ready(function () {
    $('#frmAddCaptura').validate({
        rules:{
            mTocones:{
                required:true
            },
            mCañaL:{
                required:true
            },
            mCañaPic:{
                required:true
            },
            mPuntas:{
                required:true
            },
            mRendimiento:{
                required:true
            }
        },
        messages:{
            mTocones:{
                required:"Tocones es obligatorio"
            },
            mCañaL:{
                required:"Caña Larga es requerido"
            },
            mCañaPic:{
                required:"Caña Picada es requerido"
            },
            mPuntas:{
                required:"Puntas es requerido"
            },
            mRendimiento:{
                required:"Rendimiento es requerido"
            }
        }
    });
});