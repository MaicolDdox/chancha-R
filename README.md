
<p align="center">
    <a href="https://github.com/MaicolDdox/chancha-R"_blank>
      <img src="docs/assets/logoTipo.png" width="260" alt="Logo de CrediSeal API">
    </a>
</p>

<p align="center">
  <a href="https://www.linkedin.com/in/maicol-duvan-gasca-rodas-4483923a4/?trk=public-profile-join-page" target="_blank" title="LinkedIn" style="text-decoration:none;">
    <img src="docs/assets/social/linkedin.png" height="22" alt="LinkedIn" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">LinkedIn</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://www.instagram.com/maicolddox_?utm_source=qr&igsh=cTV6enRlMW05bjY3" target="_blank" title="Instagram" style="text-decoration:none;">
    <img src="docs/assets/social/instagram.png" height="22" alt="Instagram" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">Instagram</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://github.com/MaicolDdox" target="_blank" title="GitHub" style="text-decoration:none;">
    <img src="docs/assets/social/github.png" height="22" alt="GitHub" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">GitHub</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://discordapp.com/users/1425631850453270543" target="_blank" title="Discord" style="text-decoration:none;">
    <img src="docs/assets/social/discord.png" height="22" alt="Discord" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">Discord</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="mailto:maicolindustriascode@gmail.com" target="_blank" title="Email" style="text-decoration:none;">
    <img src="docs/assets/social/gmail.png" height="22" alt="Email" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">Email</span>
  </a>
</p>

<div align="center">
  <h1>Cancha-R</h1>
  <p>Plataforma web para la gestion y reserva de canchas deportivas. Incluye un panel administrativo para administrar catalogo y operaciones, y un flujo de cliente para explorar canchas, crear reservas y completar pagos simulados.</p>
</div>

---

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
