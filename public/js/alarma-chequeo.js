// Datos de la nueva alarma (puedes ajustar estos datos según tus necesidades)
const nuevaAlarma = {
    fecha: '2023-09-28',
    hora: '14:30:00',
    usuario_chequeo: 'Nombre de Usuario',
    estado_chequeo: false,
    vecino_chequeo: 'Nombre del Vecino',
  };
  
  // Realiza una solicitud POST para crear una nueva alarma
  fetch('/api/crear-alarma', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(nuevaAlarma),
  })
    .then((response) => response.json())
    .then((nuevaAlarmaCreada) => {
      // La alarma se ha creado con éxito, ahora crea un chequeo asociado
      const nuevoChequeo = {
        fecha: nuevaAlarmaCreada.fecha,
        hora: nuevaAlarmaCreada.hora,
        usuario_chequeo: nuevaAlarmaCreada.usuario_chequeo,
        estado_chequeo: nuevaAlarmaCreada.estado_chequeo,
        vecino_chequeo: nuevaAlarmaCreada.vecino_chequeo,
      };
  
      // Realiza una solicitud POST para crear un nuevo chequeo
      fetch('/api/crear-chequeo', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(nuevoChequeo),
      })
        .then((response) => response.json())
        .then((nuevoChequeoCreado) => {
          console.log('Chequeo creado con éxito:', nuevoChequeoCreado);
        })
        .catch((error) => {
          console.error('Error al crear el chequeo:', error);
        });
    })
    .catch((error) => {
      console.error('Error al crear la alarma:', error);
    });
  