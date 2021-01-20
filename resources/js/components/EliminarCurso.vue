<template>
    <input type="submit" class="btn btn-danger d-block w-100" value="Eliminar"
    @click="eliminarCurso">
</template>

<script>
export default {
    props: ['cursoId'],
    methods: {
        eliminarCurso(){
            this.$swal({
                title: 'BB ¿Estas seguro de eliminar el curso?',
                text: "Una vez eliminado, tu lo creas de nuevo xd",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sin miedo al exito',
                cancelButtonText: 'Awantaa'
            }).then((result) => {
                if (result.isConfirmed) {

                    const params = {
                        id:this.cursoId
                    }
                    //Enviar peticion a la bd
                    axios.post(`/cursos/${this.cursoId}`, {params, _method: 'delete'})
                        .then(respuesta => {
                            this.$swal({
                                title: 'Receta Eliminada',
                                text: 'Se eliminó el curso mi lord',
                                icon: 'success'
                            });

                            //Eliminar curso del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode)
                        })
                        .catch(error => {
                            console.log(error)
                        })

                }
            })
        }
    }
}
</script>