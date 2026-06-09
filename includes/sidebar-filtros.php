<?php
// Partial: sidebar-filtros.php
// Versión PHP del formulario de filtros. Se incluye como partial en vistas.
?>
<style>
.btn-aplicar-filtros {
  background-color: var(--accent);
  color: #0D1A13;
  border: none;
  padding: 0.75rem 1rem;
  border-radius: var(--radius);
  font-weight: 700;
  cursor: pointer;
  width: 100%;
  transition: opacity 0.15s, transform 0.08s;
}
.btn-aplicar-filtros:hover { opacity: 0.95; transform: translateY(-1px); }
.filters-actions { display:flex; gap:0.5rem; margin-top:0.5rem; }
</style>

<aside class="sidebar-filters">
  <button class="sidebar-toggle-btn" id="sidebar-toggle" aria-label="Colapsar filtros">
    <span>Filtros</span>
    <span class="sidebar-toggle-icon" id="sidebar-toggle-symbol" style="font-size:1.3rem; font-weight:700; line-height:1;">−</span>
  </button>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="filters-form">
      
      <div class="filter-group text-search-group">
          <label for="buscar">Buscar</label>
          <div class="search-input-wrapper">
              <i class="bi bi-search search-icon"></i>
              <input type="text" id="buscar" name="buscar" placeholder="Buscar trabajo, empresa..." class="filter-input-text" value="<?php echo htmlspecialchars($_GET['buscar'] ?? ''); ?>">
          </div>
      </div>

      <div class="filter-group">
          <label for="provincia">Provincia</label>
          <div class="select-wrapper">
              <select id="provincia" name="provincia" class="filter-select">
                  <option value="" disabled <?php echo empty($_GET['provincia']) ? 'selected' : ''; ?>>Seleccioná una provincia</option>
                  <option value="Buenos Aires" <?php echo (($_GET['provincia'] ?? '') === 'Buenos Aires') ? 'selected' : ''; ?>>Buenos Aires</option>
                  <option value="CABA" <?php echo (($_GET['provincia'] ?? '') === 'CABA') ? 'selected' : ''; ?>>CABA</option>
                  <option value="Córdoba" <?php echo (($_GET['provincia'] ?? '') === 'Córdoba') ? 'selected' : ''; ?>>Córdoba</option>
                  <option value="Santa Fe" <?php echo (($_GET['provincia'] ?? '') === 'Santa Fe') ? 'selected' : ''; ?>>Santa Fe</option>
                  <option value="Mendoza" <?php echo (($_GET['provincia'] ?? '') === 'Mendoza') ? 'selected' : ''; ?>>Mendoza</option>
              </select>
              <i class="bi bi-chevron-down select-chevron"></i>
          </div>
      </div>

      <div class="filter-group">
          <label for="localidad">Localidad</label>
          <div class="select-wrapper">
              <select id="localidad" name="localidad" class="filter-select" <?php echo empty($_GET['provincia']) ? 'disabled' : ''; ?> >
                  <option value="" disabled <?php echo empty($_GET['localidad']) ? 'selected' : ''; ?>>Seleccioná primero una provincia</option>
              </select>
              <i class="bi bi-chevron-down select-chevron"></i>
          </div>
      </div>

      <div class="filter-group">
          <label for="categoria">Categoría</label>
          <div class="select-wrapper">
              <select id="categoria" name="categoria" class="filter-select">
                  <option value="Ingenieria" <?php echo (($_GET['categoria'] ?? '') === 'Ingenieria') ? 'selected' : ''; ?>>Ingeniería</option>
                  <option value="Tecnología" <?php echo (($_GET['categoria'] ?? '') === 'Tecnología') ? 'selected' : ''; ?>>Tecnología</option>
                  <option value="Industria y produccion" <?php echo (($_GET['categoria'] ?? '') === 'Industria y produccion') ? 'selected' : ''; ?>>Industria y producción</option>
                  <option value="Marketing" <?php echo (($_GET['categoria'] ?? '') === 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                  <option value="Ventas" <?php echo (($_GET['categoria'] ?? '') === 'Ventas') ? 'selected' : ''; ?>>Ventas</option>
                  <option value="Recursos Humanos" <?php echo (($_GET['categoria'] ?? '') === 'Recursos Humanos') ? 'selected' : ''; ?>>Recursos Humanos</option>
                  <option value="Diseño" <?php echo (($_GET['categoria'] ?? '') === 'Diseño') ? 'selected' : ''; ?>>Diseño</option>
                  <option value="Administración" <?php echo (($_GET['categoria'] ?? '') === 'Administración') ? 'selected' : ''; ?>>Administración</option>
                  <option value="Finanzas" <?php echo (($_GET['categoria'] ?? '') === 'Finanzas') ? 'selected' : ''; ?>>Finanzas</option>
              </select>
              <i class="bi bi-chevron-down select-chevron"></i>
          </div>
      </div>

      <div class="filter-accordion open">
          <div class="accordion-header">
              <span>Tipo de contrato</span>
              <i class="bi bi-chevron-up accordion-chevron"></i>
          </div>
          <div class="accordion-content">
              <?php $contratos = $_GET['contrato'] ?? [];?>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="contrato[]" value="pasantia" <?php echo in_array('pasantia', $contratos) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Pasantía
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="contrato[]" value="part-time" <?php echo in_array('part-time', $contratos) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Part-time
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="contrato[]" value="full-time" <?php echo in_array('full-time', $contratos) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Full-time
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="contrato[]" value="practica profesional" <?php echo in_array('practica profesional', $contratos) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Pasantía profesional
              </label>
          </div>
      </div>

      <div class="filter-accordion open">
          <div class="accordion-header">
              <span>Modalidad</span>
              <i class="bi bi-chevron-up accordion-chevron"></i>
          </div>
          <div class="accordion-content">
              <?php $modalidades = $_GET['modalidad'] ?? [];?>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="modalidad[]" value="presencial" <?php echo in_array('presencial', $modalidades) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Presencial
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="modalidad[]" value="remoto" <?php echo in_array('remoto', $modalidades) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Remoto
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="modalidad[]" value="mixto" <?php echo in_array('mixto', $modalidades) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Mixto
              </label>
          </div>
      </div>

      <div class="filter-accordion open">
          <div class="accordion-header">
              <span>Carreras UTN FRH</span>
              <i class="bi bi-chevron-up accordion-chevron"></i>
          </div>
          <div class="accordion-content">
              <?php $carreras = $_GET['carrera'] ?? [];?>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="aeronautica-aeroespacial" <?php echo in_array('aeronautica-aeroespacial', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Ingeniería Aeronáutica/Aeroespacial
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="electronica" <?php echo in_array('electronica', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Ingeniería Electrónica
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="ferroviaria" <?php echo in_array('ferroviaria', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Ingeniería Ferroviaria
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="industrial" <?php echo in_array('industrial', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Ingeniería Industrial
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="mecanica" <?php echo in_array('mecanica', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Ingeniería Mecánica
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="bio" <?php echo in_array('bio', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Bioingeniería
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="tec-tup" <?php echo in_array('tec-tup', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Tecnicatura Universitaria en Programación
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="tec-tuoa" <?php echo in_array('tec-tuoa', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Tecnicatura Universitaria en Operación de Aeronaves
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="tec-tumrf" <?php echo in_array('tec-tumrf', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Tecnicatura Universitaria en Material Rodante Ferroviario
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="tec-tudpv" <?php echo in_array('tec-tudpv', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Tecnicatura Universitaria en Desarrollo y Producción de Videojuegos
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="tec-tuhst" <?php echo in_array('tec-tuhst', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Tecnicatura Universitaria en Higiene y Seguridad en el Trabajo
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="tec-tucem" <?php echo in_array('tec-tucem', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Tecnicatura Universitaria en Comercio Electrónico y Marketing Digital
              </label>
              <label class="filter-checkbox-label">
                  <input type="checkbox" name="carrera[]" value="tec-tul" <?php echo in_array('tec-tul', $carreras) ? 'checked' : ''; ?> >
                  <span class="custom-checkbox"></span> Tecnicatura Universitaria en Logística
              </label>
          </div>
      </div>

      <div class="filter-accordion open">
          <div class="accordion-header">
              <span>Tecnologías / Herramientas</span>
              <i class="bi bi-chevron-up accordion-chevron"></i>
          </div>
          <div class="accordion-content">
              <div class="tag-input-wrapper">
                  <input type="text" id="tecnologia-input" name="tecnologia" placeholder="Ej: C#, Oracle, Git..." class="filter-input-text" value="<?php echo htmlspecialchars($_GET['tecnologia'] ?? ''); ?>">
                  <button type="button" id="btn-add-tag" class="btn-input-append">+</button>
              </div>
              <div id="tags-container" class="tags-flex-container"></div>
          </div>
      </div>

      <div class="filter-accordion">
          <div class="accordion-header">
              <span>Fecha de publicación</span>
              <i class="bi bi-chevron-down accordion-chevron"></i>
          </div>
          <div class="accordion-content">
              <label class="filter-checkbox-label">
                  <input type="radio" name="fecha" value="hoy" <?php echo (($_GET['fecha'] ?? '') === 'hoy') ? 'checked' : ''; ?> >
                  <span class="custom-radio"></span> Hoy
              </label>
              <label class="filter-checkbox-label">
                  <input type="radio" name="fecha" value="ultima-semana" <?php echo (($_GET['fecha'] ?? '') === 'ultima-semana') ? 'checked' : ''; ?> >
                  <span class="custom-radio"></span> Última semana
              </label>
              <label class="filter-checkbox-label">
                  <input type="radio" name="fecha" value="ultimo-mes" <?php echo (($_GET['fecha'] ?? '') === 'ultimo-mes') ? 'checked' : ''; ?> >
                  <span class="custom-radio"></span> Último mes
              </label>
              <label class="filter-checkbox-label">
                  <input type="radio" name="fecha" value="total" <?php echo (($_GET['fecha'] ?? 'total') === 'total') ? 'checked' : ''; ?> >
                  <span class="custom-radio"></span> Cualquier fecha
              </label>
          </div>
      </div>

      <div class="filters-actions">
          <button type="submit" class="btn-aplicar-filtros">Aplicar filtros</button>
      </div>
  </form>
</aside>