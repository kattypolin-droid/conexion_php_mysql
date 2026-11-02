<?php
$secciones = [
	[
		'titulo' => 'Sistema académico',
		'color' => 'teal',
		'descripcion' => 'Creación de la base académica, tablas, datos de prueba y consultas.',
		'archivos' => [
			['archivo' => 'creadb_academico.php', 'nombre' => 'Crear base académica', 'detalle' => 'Crea la base de datos academico.', 'tipo' => 'Configuración', 'confirmar' => true],
			['archivo' => 'creatablas_academico.php', 'nombre' => 'Crear tablas académicas', 'detalle' => 'Crea las tablas de cursos y alumnos.', 'tipo' => 'Configuración', 'confirmar' => true],
			['archivo' => 'insertar_datos_academico.php', 'nombre' => 'Insertar datos de ejemplo', 'detalle' => 'Agrega cursos y alumnos de muestra.', 'tipo' => 'Modifica datos', 'confirmar' => true],
			['archivo' => 'consultas_academico.php', 'nombre' => 'Consultar información académica', 'detalle' => 'Muestra cursos, alumnos y matrículas.', 'tipo' => 'Consulta'],
			['archivo' => 'conexion_academico.php', 'nombre' => 'Conexión académica', 'detalle' => 'Conexión PDO a la base academico.', 'tipo' => 'Conexión'],
			['archivo' => 'conex_academico.php', 'nombre' => 'Conexión al servidor académico', 'detalle' => 'Conexión PDO al servidor MySQL.', 'tipo' => 'Conexión'],
		],
	],
	[
		'titulo' => 'Usuarios y operaciones CRUD',
		'color' => 'coral',
		'descripcion' => 'Ejemplos de inserción, consulta, filtrado, ordenamiento, actualización y eliminación.',
		'archivos' => [
			['archivo' => 'creadb.php', 'nombre' => 'Crear base de datos data', 'detalle' => 'Prepara la base para los ejemplos de usuarios.', 'tipo' => 'Configuración', 'confirmar' => true],
			['archivo' => 'creatabla.php', 'nombre' => 'Crear tabla de usuarios', 'detalle' => 'Crea la tabla t_usuario en data.', 'tipo' => 'Configuración', 'confirmar' => true],
			['archivo' => 'insertar.php', 'nombre' => 'Insertar un usuario', 'detalle' => 'Inserta un registro de ejemplo.', 'tipo' => 'Modifica datos', 'confirmar' => true],
			['archivo' => 'insertMultiple.php', 'nombre' => 'Inserción múltiple', 'detalle' => 'Inserta varios registros en una transacción.', 'tipo' => 'Modifica datos', 'confirmar' => true],
			['archivo' => 'prepare.php', 'nombre' => 'Inserción preparada', 'detalle' => 'Inserta registros usando parámetros preparados.', 'tipo' => 'Modifica datos', 'confirmar' => true],
			['archivo' => 'seleccionar.php', 'nombre' => 'Seleccionar usuarios', 'detalle' => 'Consulta todos los registros.', 'tipo' => 'Consulta'],
			['archivo' => 'filtrar.php', 'nombre' => 'Filtrar usuarios', 'detalle' => 'Busca usuarios por nombre.', 'tipo' => 'Consulta'],
			['archivo' => 'ordenar.php', 'nombre' => 'Ordenar usuarios', 'detalle' => 'Ordena los registros por nombre.', 'tipo' => 'Consulta'],
			['archivo' => 'actualizar.php', 'nombre' => 'Actualizar usuario', 'detalle' => 'Actualiza el usuario con ID 2.', 'tipo' => 'Modifica datos', 'confirmar' => true],
			['archivo' => 'eliminar.php', 'nombre' => 'Eliminar usuario', 'detalle' => 'Elimina el usuario con ID 3.', 'tipo' => 'Modifica datos', 'confirmar' => true],
			['archivo' => 'conexion.php', 'nombre' => 'Conexión a data', 'detalle' => 'Conexión PDO a la base de datos data.', 'tipo' => 'Conexión'],
			['archivo' => 'conex.php', 'nombre' => 'Conexión al servidor', 'detalle' => 'Conexión PDO al servidor MySQL.', 'tipo' => 'Conexión'],
		],
	],
];

$badges = [
	'Configuración' => 'badge-setup',
	'Consulta' => 'badge-query',
	'Modifica datos' => 'badge-change',
	'Conexión' => 'badge-connect',
];

$totalArchivos = 0;
$totalCambios = 0;
foreach ($secciones as $seccion) {
	$totalArchivos += count($seccion['archivos']);
	foreach ($seccion['archivos'] as $item) {
		if (!empty($item['confirmar'])) {
			$totalCambios++;
		}
	}
}

$archivosDisponibles = [];
foreach ($secciones as $seccion) {
	foreach ($seccion['archivos'] as $item) {
		$archivosDisponibles[$item['archivo']] = true;
	}
}

if (isset($_GET['codigo'])) {
	$archivoSolicitado = $_GET['codigo'];
	if (!is_string($archivoSolicitado) || !isset($archivosDisponibles[$archivoSolicitado])) {
		http_response_code(404);
		exit('Archivo no disponible.');
	}

	$rutaArchivo = __DIR__ . DIRECTORY_SEPARATOR . $archivoSolicitado;
	$codigo = file_get_contents($rutaArchivo);
	if ($codigo === false) {
		http_response_code(500);
		exit('No se pudo leer el archivo.');
	}

	ini_set('highlight.comment', '#87958f');
	ini_set('highlight.default', '#f4f4f5');
	ini_set('highlight.html', '#80cbc4');
	ini_set('highlight.keyword', '#ff8a65');
	ini_set('highlight.string', '#f4c95d');
	header('Content-Type: text/html; charset=UTF-8');
	echo '<pre class="source-code">' . highlight_string($codigo, true) . '</pre>';
	exit;
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ACADEMICO | Panel de archivos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		:root {
			--page-bg: #000;
			--ink: #f5f5f5;
			--muted: #b7c1bd;
			--teal: #087e78;
			--coral: #e87959;
			--sun: #f4c95d;
			--card-purple: #8146c3;
			--border-yellow: #ffe15a;
			--code-accent: #35dbc7;
			--result-accent: #ff8068;
		}

		body {
			min-height: 100vh;
			background: var(--page-bg);
			color: var(--ink);
		}

		.directory, .preview-panel {
			border: 1px solid #dce5df;
			border-radius: 1rem;
			background: #fff;
			box-shadow: 0 12px 30px rgba(23, 52, 50, .07);
		}

		.directory { padding: 0; border: 0; border-radius: 0; background: transparent; box-shadow: none; }
		.directory-head {
			display: grid;
			grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr);
			align-items: center;
			gap: .75rem;
			padding: .5rem 0 1.75rem;
		}
		.directory-head h1 {
			grid-column: 2;
			grid-row: 1;
			justify-self: center;
			display: inline-block;
			margin: 0;
			padding: 0 .25rem .65rem;
			border-bottom: 3px solid var(--border-yellow);
			color: #fff;
			font-size: 2.2rem;
			font-weight: 750;
			text-shadow: 0 0 12px rgba(255, 225, 90, .4), 0 0 28px rgba(140, 80, 220, .35);
		}
		.corner-clock {
			grid-column: 3;
			grid-row: 1;
			justify-self: end;
			display: inline-flex;
			align-items: center;
			gap: .55rem;
			color: #fff;
			font-family: var(--bs-font-monospace);
			font-size: 1rem;
			font-weight: 700;
			font-variant-numeric: tabular-nums;
		}
		.clock-face {
			position: relative;
			width: 4rem;
			height: 4rem;
			flex: 0 0 4rem;
			border: 2px solid #111;
			border-radius: 50%;
			background: #fff;
			box-shadow: inset 0 0 0 3px rgba(0, 0, 0, .06), 0 0 14px rgba(255, 255, 255, .2);
		}
		.clock-face::before {
			position: absolute;
			inset: .25rem;
			border: 1px solid rgba(0, 0, 0, .28);
			border-radius: 50%;
			content: '';
		}
		.clock-number {
			position: absolute;
			z-index: 1;
			color: #111;
			font-family: var(--bs-font-monospace);
			font-size: .48rem;
			line-height: 1;
		}
		.clock-twelve { top: .32rem; left: 50%; transform: translateX(-50%); }
		.clock-three { top: 50%; right: .35rem; transform: translateY(-50%); }
		.clock-six { bottom: .32rem; left: 50%; transform: translateX(-50%); }
		.clock-nine { top: 50%; left: .35rem; transform: translateY(-50%); }
		.clock-hand {
			position: absolute;
			z-index: 2;
			bottom: 50%;
			left: 50%;
			border-radius: 99px;
			transform-origin: 50% 100%;
			transition: transform .2s ease-out;
		}
		.clock-hour { width: 3px; height: .85rem; background: #111; }
		.clock-minute { width: 2px; height: 1.15rem; background: #111; }
		.clock-second { width: 1px; height: 1.35rem; background: #111; }
		.clock-pivot {
			position: absolute;
			z-index: 3;
			top: 50%;
			left: 50%;
			width: .42rem;
			height: .42rem;
			border: 1px solid #111;
			border-radius: 50%;
			background: #111;
			transform: translate(-50%, -50%);
		}
		.file-directory { padding: 0; }
		.file-stack { margin-top: 0; }
		.file-card {
			display: block;
			height: 100%;
			min-height: 4.5rem;
			padding: 1.1rem;
			border: 1px solid var(--border-yellow);
			border-radius: .9rem;
			background: linear-gradient(135deg, #8b4dcc 0%, #7840bd 52%, #63359e 100%);
			color: #fff;
			text-decoration: none;
			box-shadow: 0 0 0 1px rgba(255, 225, 90, .32), 0 7px 20px rgba(99, 53, 158, .36);
			transition: transform .24s ease, border-color .24s ease, background .24s ease, box-shadow .24s ease;
			animation: card-arrive .42s ease both;
		}
		.file-card:hover, .file-card:focus-visible {
			transform: translateY(-4px);
			border-color: #fff49a;
			background: linear-gradient(135deg, #a35ee5 0%, #8a4cce 55%, #7540b5 100%);
			color: #fff;
			box-shadow: 0 0 0 1px rgba(255, 244, 154, .7), 0 0 22px rgba(255, 225, 90, .38), 0 12px 28px rgba(99, 53, 158, .5);
		}
		.file-card:focus-visible { outline: 1px solid #fff49a; outline-offset: 2px; }
		.file-card.is-active {
			border-color: var(--border-yellow);
		}
		.file-card-name { display: block; font-family: var(--bs-font-monospace); font-size: 1.08rem; font-weight: 750; }
		.file-stack > div:nth-child(4n + 2) .file-card { animation-delay: .05s; }
		.file-stack > div:nth-child(4n + 3) .file-card { animation-delay: .1s; }
		.file-stack > div:nth-child(4n) .file-card { animation-delay: .15s; }
		@keyframes card-arrive {
			from { opacity: 0; filter: blur(2px); }
			to { opacity: 1; filter: blur(0); }
		}

		.viewer-heading { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin: .25rem 0 1rem; }
		.viewer-heading h2 { margin: 0; font-size: 1.25rem; }
		.viewer-filename { color: var(--muted); font-family: var(--bs-font-monospace); font-size: .8rem; }
		.preview-panel { overflow: hidden; border: 1px solid #dce5df; border-radius: 1rem; }
		.preview-panel-code {
			border-color: var(--code-accent);
			box-shadow: 0 0 0 1px rgba(53, 219, 199, .4), 0 0 30px rgba(53, 219, 199, .24);
		}
		.preview-panel-output {
			border-color: var(--result-accent);
			box-shadow: 0 0 0 1px rgba(255, 128, 104, .4), 0 0 30px rgba(255, 128, 104, .24);
		}
		.preview-panel-head { display: flex; justify-content: space-between; align-items: center; min-height: 3.6rem; padding: .85rem 1.1rem; border-bottom: 1px solid #e1e8e4; background: #fbfcfa; }
		.preview-panel-head h3 { margin: 0; font-size: 1.1rem; font-weight: 750; }
		.panel-mark { display: inline-block; width: .55rem; height: .55rem; margin-right: .5rem; border-radius: 50%; background: var(--teal); }
		.preview-panel-output .panel-mark { background: var(--coral); }
		.source-scroll, .preview-frame { width: 100%; height: 34rem; max-height: 65vh; min-height: 20rem; }
		.preview-panel-code .preview-panel-head { border-bottom-color: var(--code-accent); background: #07363a; color: #e8fffb; }
		.preview-panel-code .preview-panel-head .small { color: #b6eee6 !important; }
		.preview-panel-code .panel-mark { background: var(--code-accent); }
		.preview-panel-output .preview-panel-head { border-bottom-color: #ffd95e; background: linear-gradient(100deg, #df574e, #f47b55); color: #fff; }
		.preview-panel-output .preview-panel-head .small { color: #fff4e8 !important; }
		.preview-panel-output .panel-mark { background: #ffe15a; }
		.source-scroll { overflow: auto; background: #080b0b; }
		.source-code { min-width: max-content; min-height: 100%; margin: 0; padding: 1rem; background: #080b0b; color: #f4f4f5; font-family: var(--bs-font-monospace); font-size: .85rem; line-height: 1.7; tab-size: 4; }
		.preview-frame { display: block; border: 0; background: #fff; }
		.viewer-controls { display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #dce5df; }
		.viewer-position { color: var(--muted); font-size: .82rem; }
		.btn-viewer { min-height: 2.6rem; border-radius: .65rem; font-weight: 650; }
		.btn-viewer-primary { border-color: #08048d; background: #087e78; color: #fff; }
		.btn-viewer-primary:hover { border-color: #76d9d2; background: #066862; color: #fff; }
		.btn-viewer:disabled { opacity: .48; }
		.badge { padding: .45rem .6rem; font-weight: 650; }
		.badge-setup { background: #e7eef0; color: #38535a; }
		.badge-query { background: #d9f0e9; color: #126250; }
		.badge-change { background: #fff0c8; color: #795300; }
		.badge-connect { background: #fce2d9; color: #91462f; }
		.notice { border-left: 4px solid var(--coral) !important; background: #fff0e9; color: #713e2e; }

		@media (prefers-reduced-motion: reduce) {
			*, *::before, *::after { transition-duration: .01ms !important; animation-duration: .01ms !important; animation-iteration-count: 1 !important; }
		}

		@media (max-width: 575.98px) {
			.directory-head { grid-template-columns: minmax(0, 1fr) auto; gap: .5rem; }
			.directory-head h1 { grid-column: 1; justify-self: start; font-size: 1.8rem; }
			.corner-clock { grid-column: 2; gap: .4rem; font-size: .85rem; }
			.clock-face { width: 3.4rem; height: 3.4rem; flex-basis: 3.4rem; }
			.source-scroll, .preview-frame { height: 24rem; max-height: 55vh; min-height: 16rem; }
			.viewer-controls { align-items: stretch; flex-direction: column; }
			.viewer-controls .btn-group { width: 100%; }
			.viewer-controls .btn { flex: 1; padding-inline: .5rem; font-size: .82rem; }
		}
	</style>
</head>
<body>
		<main class="container-fluid px-3 px-xl-4 py-4 py-lg-5">
			<section id="file-library" class="directory" aria-label="Archivos del proyecto">
				<div class="directory-head">
					<h1>Archivos</h1>
					<div class="corner-clock" aria-label="Hora local actual">
						<div class="clock-face" aria-hidden="true">
							<span class="clock-number clock-twelve">12</span>
							<span class="clock-number clock-three">3</span>
							<span class="clock-number clock-six">6</span>
							<span class="clock-number clock-nine">9</span>
							<span id="clock-hour" class="clock-hand clock-hour"></span>
							<span id="clock-minute" class="clock-hand clock-minute"></span>
							<span id="clock-second" class="clock-hand clock-second"></span>
							<span class="clock-pivot"></span>
						</div>
						<time id="corner-clock" aria-live="off">--:--:--</time>
					</div>
				</div>
				<div class="file-directory">
					<div class="row g-3 file-stack">
						<?php foreach ($secciones as $seccion): ?>
								<?php foreach ($seccion['archivos'] as $item): ?>
									<div class="col-sm-6 col-lg-4 col-xl-3">
										<a
										class="file-card"
											href="<?= htmlspecialchars($item['archivo'], ENT_QUOTES, 'UTF-8') ?>"
										data-file="<?= htmlspecialchars($item['archivo'], ENT_QUOTES, 'UTF-8') ?>"
										data-title="<?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?>"
										data-type="<?= htmlspecialchars($item['tipo'], ENT_QUOTES, 'UTF-8') ?>"
										data-confirm="<?= !empty($item['confirmar']) ? 'true' : 'false' ?>"
										aria-current="false"
									>
											<span class="file-card-name"><?= htmlspecialchars($item['archivo'], ENT_QUOTES, 'UTF-8') ?></span>
										</a>
									</div>
								<?php endforeach; ?>
					<?php endforeach; ?>
					</div>
				</div>
			</section>

			<section id="file-viewer" class="viewer-view" aria-label="Código y vista previa" hidden>
				<div class="viewer-heading">
					<div>
						<p class="text-uppercase small fw-bold text-secondary mb-1">Archivo seleccionado</p>
						<h2 id="active-title">Selecciona un archivo</h2>
						<span id="active-file" class="viewer-filename"></span>
					</div>
					<div class="d-flex align-items-center gap-2">
						<span id="active-badge" class="badge rounded-pill align-self-center"></span>
						<button id="back-to-files" class="btn btn-outline-secondary btn-viewer" type="button">Todos los archivos</button>
					</div>
				</div>

				<div class="row g-3">
					<div class="col-md-6">
						<section class="preview-panel preview-panel-code" aria-label="Código fuente">
							<div class="preview-panel-head"><h3><span class="panel-mark"></span>Código PHP</h3><span class="small">Colores de sintaxis</span></div>
							<div id="code-view" class="source-scroll" tabindex="0" aria-live="polite"><pre class="source-code"></pre></div>
						</section>
					</div>
					<div class="col-md-6">
						<section class="preview-panel preview-panel-output" aria-label="Vista previa del archivo">
							<div class="preview-panel-head"><h3><span class="panel-mark"></span>Lo que carga</h3><span class="small text-secondary">Vista previa</span></div>
							<iframe id="preview-frame" class="preview-frame" title="Vista previa del archivo" sandbox="allow-same-origin" src="about:blank"></iframe>
						</section>
					</div>
				</div>

				<div class="viewer-controls">
					<span id="viewer-position" class="viewer-position"></span>
					<div class="btn-group" role="group" aria-label="Navegación entre archivos">
						<button id="previous-file" class="btn btn-outline-secondary btn-viewer" type="button" disabled>Anterior</button>
						<button id="open-file" class="btn btn-outline-success btn-viewer" type="button">Abrir archivo</button>
						<button id="next-file" class="btn btn-viewer btn-viewer-primary" type="button" disabled>Siguiente</button>
					</div>
				</div>
			</section>
		</div>
	</main>

	<script>
		const fileCards = Array.from(document.querySelectorAll('.file-card'));
		const codeView = document.getElementById('code-view');
		const previewFrame = document.getElementById('preview-frame');
		const activeTitle = document.getElementById('active-title');
		const activeFile = document.getElementById('active-file');
		const activeBadge = document.getElementById('active-badge');
		const viewerPosition = document.getElementById('viewer-position');
		const previousButton = document.getElementById('previous-file');
		const openButton = document.getElementById('open-file');
		const nextButton = document.getElementById('next-file');
		const fileLibrary = document.getElementById('file-library');
		const fileViewer = document.getElementById('file-viewer');
		const backButton = document.getElementById('back-to-files');
		const clockDisplay = document.getElementById('corner-clock');
		const hourHand = document.getElementById('clock-hour');
		const minuteHand = document.getElementById('clock-minute');
		const secondHand = document.getElementById('clock-second');
		const badgeStyles = {
			'Configuración': 'badge-setup',
			'Consulta': 'badge-query',
			'Modifica datos': 'badge-change',
			'Conexión': 'badge-connect'
		};
		let currentIndex = -1;
		const clockFormatter = new Intl.DateTimeFormat(undefined, {
			hour: '2-digit',
			minute: '2-digit',
			second: '2-digit',
			hourCycle: 'h23'
		});
		function updateClock() {
			const now = new Date();
			const seconds = now.getSeconds();
			const minutes = now.getMinutes();
			const hours = now.getHours() % 12;
			hourHand.style.transform = 'translateX(-50%) rotate(' + ((hours + minutes / 60) * 30) + 'deg)';
			minuteHand.style.transform = 'translateX(-50%) rotate(' + ((minutes + seconds / 60) * 6) + 'deg)';
			secondHand.style.transform = 'translateX(-50%) rotate(' + (seconds * 6) + 'deg)';
			clockDisplay.dateTime = now.toISOString();
			clockDisplay.textContent = clockFormatter.format(now);
		}
		updateClock();
		window.setInterval(updateClock, 1000);

		previewFrame.addEventListener('load', () => {
			const previewDocument = previewFrame.contentDocument;
			if (!previewDocument || !previewDocument.head) return;

			const previousTheme = previewDocument.getElementById('preview-theme');
			if (previousTheme) previousTheme.remove();

			const theme = previewDocument.createElement('style');
			theme.id = 'preview-theme';
			theme.textContent = [
				'html, body { min-height: 100%; background: #fff !important; color: #173432 !important; }',
				'body { margin: 0; padding: 1.25rem; font-family: "Segoe UI", sans-serif; font-size: 20px; line-height: 1.65; }',
				'h1, h2, h3, h4, h5 { color: #087e78 !important; font-weight: 700; line-height: 1.3; }',
				'p, li { color: #304c46; }',
				'strong, b { color: #b75038; }',
				'a { color: #087e78; }',
				'hr { border-color: #d6e7e1; opacity: 1; }',
				'table { width: 100%; border-collapse: collapse; }',
				'th { background: #e5f2ee; color: #173432; }',
				'td, th { padding: .55rem .7rem; border: 1px solid #d5e0dc; }',
				'@media (max-width: 600px) { body { padding: 1rem; font-size: 18px; } }'
			].join('\n');
			previewDocument.head.appendChild(theme);
		});

		function selectFile(index, askBeforeRunning) {
			const card = fileCards[index];
			if (!card) return false;

			if (askBeforeRunning && card.dataset.confirm === 'true') {
				const accepted = window.confirm('Este archivo puede modificar la base de datos. ¿Deseas ejecutarlo?');
				if (!accepted) return false;
			}

			currentIndex = index;
			fileLibrary.hidden = true;
			fileViewer.hidden = false;
			fileCards.forEach((fileCard, cardIndex) => {
				const selected = cardIndex === currentIndex;
				fileCard.classList.toggle('is-active', selected);
				fileCard.setAttribute('aria-current', selected ? 'true' : 'false');
			});

			activeTitle.textContent = card.dataset.title;
			activeFile.textContent = card.dataset.file;
			activeBadge.textContent = card.dataset.type;
			activeBadge.className = 'badge rounded-pill align-self-center ' + (badgeStyles[card.dataset.type] || 'badge-setup');
			previewFrame.title = 'Vista previa de ' + card.dataset.file;
			viewerPosition.textContent = (currentIndex + 1) + ' de ' + fileCards.length;
			previousButton.disabled = currentIndex === 0;
			openButton.disabled = false;
			nextButton.disabled = currentIndex === fileCards.length - 1;
			codeView.innerHTML = '<pre class="source-code">Cargando código...</pre>';
			previewFrame.src = card.dataset.file;

			fetch('index.php?codigo=' + encodeURIComponent(card.dataset.file), { cache: 'no-store' })
				.then((response) => {
					if (!response.ok) throw new Error('No se pudo cargar el código.');
					return response.text();
				})
				.then((source) => {
					if (currentIndex === index) codeView.innerHTML = source;
				})
				.catch(() => {
					if (currentIndex === index) codeView.textContent = 'No se pudo cargar el código fuente.';
				});

			return true;
		}

		fileCards.forEach((card, index) => {
			card.addEventListener('click', (event) => {
				event.preventDefault();
				selectFile(index, true);
			});
		});

		previousButton.addEventListener('click', () => selectFile(currentIndex - 1, true));
		nextButton.addEventListener('click', () => selectFile(currentIndex + 1, true));
		openButton.addEventListener('click', () => {
			if (currentIndex >= 0) window.open(fileCards[currentIndex].dataset.file, '_blank', 'noopener');
		});
		backButton.addEventListener('click', () => {
			fileViewer.hidden = true;
			fileLibrary.hidden = false;
			fileLibrary.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});

		openButton.disabled = true;
	</script>
</body>
</html>
