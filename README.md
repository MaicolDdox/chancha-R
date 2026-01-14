
<p align="center">
    <a href="https://github.com/MaicolDdox/chancha-R"_blank>
      <img src="docs/assets/logoTipo.png" width="260" alt="Logo de CrediSeal API">
    </a>
</p>

[![GitHub](https://img.shields.io/badge/GitHub-MaicolDdox-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/MaicolDdox)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/maicol-duvan-gasca-rodas-4483923a4/?trk=public-profile-join-page)
[![Instagram](https://img.shields.io/badge/Instagram-@maicolddox__-E4405F?style=for-the-badge&logo=instagram&logoColor=white)](https://www.instagram.com/maicolddox_?utm_source=qr&igsh=cTV6enRlMW05bjY3)
[![Discord](https://img.shields.io/badge/Discord-5865F2?style=for-the-badge&logo=discord&logoColor=white)](https://discordapp.com/users/1425631850453270543)
[![Facebook](https://img.shields.io/badge/Facebook-1877F2?style=for-the-badge&logo=facebook&logoColor=white)](https://www.facebook.com/profile.php?id=61586710675179&sk=about_contact_and_basic_info)

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
