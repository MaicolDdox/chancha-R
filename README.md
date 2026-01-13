# Cancha-R

<!-- Logo del software -->
<p align="center">
  <img src="docs/logo.png" alt="Logo Cancha-R" width="180">
</p>

Plataforma web para la gestion y reserva de canchas deportivas. Incluye un panel administrativo para administrar catalogo y operaciones, y un flujo de cliente para explorar canchas, crear reservas y completar pagos simulados.

## Administrador

- Acceso exclusivo por `/{admin}/login` (por defecto: `http://tu-dominio/admin/login`).
- Desde el panel admin se gestionan deportes, categorias, canchas (zonas), reservas y facturas.
- El administrador es responsable de mantener el catalogo disponible y los estados de las canchas.

## Flujo del cliente

- Registro en `/register` y acceso en `/login`.
- Al iniciar sesion el cliente llega al catalogo en `/dashboard`.
- El cliente explora el catalogo, aplica filtros y entra a detalles en `/zones/{zone}`.
- Para reservar usa `/reservations/create?zone={id}` y completa el formulario con fecha, horas y contacto.
- El sistema genera una factura y el cliente completa el pago simulado en `/invoices/{invoice}`.
- El cliente consulta su historial en `/reservations` y `/invoices`.

## Rutas principales

- Catalogo: `/dashboard`
- Detalle de cancha: `/zones/{zone}`
- Crear reserva: `/reservations/create?zone={id}`
- Reservaciones: `/reservations`
- Facturas: `/invoices`
- Pago de factura: `/invoices/{invoice}`
