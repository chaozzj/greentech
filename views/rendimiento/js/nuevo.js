/**
 * Created by lilsa on 04/05/2017.
 */
$(document).ready(function () {
    $('#frmAddRendimiento').validate({
        rules:{
            mCosechado:{
                required:true
            },
            mGirando:{
                required:true
            },
            mVolquete:{
                required:true
            },
            mTransporte:{
                required:true
            },
            mReparacion:{
                required:true
            },
            mRevision:{
                required:true
            },
            mDistraido:{
                required:true
            }
        },
        messages:{
            mCosechado:{
                required:"Cosechando es obligatorio"
            },
            mGirando:{
                required:"Girando es requerido"
            },
            mVolquete:{
                required:"Volquete es requerido"
            },
            mTransporte:{
                required:"Transporte es requerido"
            },
            mReparacion:{
                required:"Reparacion es requerido"
            },
            mRevision:{
                required:"Revision es requerido"
            },
            mDistraido:{
                required:"Distraido es requerido"
            }
        }
    });
});