<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;

/**
 * Manipular la tabla partida_generica
 */
class PartidaGenericaController extends Controller
{
	/**
	 * Cargar la lista de partidas genéricas a la BD
	 */
	public function actionCargar()
	{
		echo "Insertando registros...\n";
		
		$resultado = Yii::$app->db->createCommand('INSERT INTO partida_generica (cuenta, partida, generica, nombre, estatus) VALUES
			("3","01","01","Impuestos directos",1),
			("3","01","02","Impuestos indirectos",1),
			("3","01","03","Ingresos por tasas",1),
			("3","01","04","Ingresos por contribuciones especiales",1),
			("3","01","05","Ingresos por aportes y contribuciones a la seguridad social",1),
			("3","01","06","Ingresos del dominio petrolero",1),
			("3","01","07","Ingresos del dominio minero",1),
			("3","01","08","Ingresos del dominio forestal",1),
			("3","01","09","Ingresos por la venta de bienes y servicios de la administración pública",1),
			("3","01","10","Ingresos de la propiedad",1),
			("3","01","11","Diversos ingresos",1),
			("3","01","99","Otros ingresos ordinarios",1),
			("3","02","01","Endeudamiento público interno",1),
			("3","02","02","Endeudamiento público externo",1),
			("3","02","03","Ingresos por operaciones diversas",1),
			("3","02","04","Reintegro de fondos correspondientes a ejercicios anteriores",1),
			("3","02","05","Ingresos por obtención indebida de devoluciones o reintegros",1),
			("3","02","06","Impuesto a las transacciones financieras",1),
			("3","02","99","Otros ingresos extraordinarios",1),
			("3","03","01","Venta bruta de bienes",1),
			("3","03","02","Venta bruta de servicios",1),
			("3","03","03","Ingresos financieros de instituciones financieras bancarias",1),
			("3","03","04","Ingresos financieros de instituciones financieras no bancarias",1),
			("3","03","05","Ingresos por operaciones de seguro",1),
			("3","03","99","Otros ingresos de operación",1),
			("3","04","01","Subsidios para precios y tarifas",1),
			("3","04","02","Incentivos a la exportación",1),
			("3","04","99","Otros ingresos ajenos a la operación",1),
			("3","05","01","Transferencias y donaciones corrientes",1),
			("3","05","02","Transferencias y donaciones de capital",1),
			("3","05","03","Situado",1),
			("3","05","04","Subsidio de Régimen Especial",1),
			("3","05","05","Subsidio de Capitalidad",1),
			("3","05","06","Asignaciones Económicas Especiales (LAEE)",1),
			("3","05","07","Fondo Intergubernamental para la Descentralización (FIDES)",1),
			("3","05","08","Fondo de Compensación Interterritorial",1),
			("3","05","09","Aportes del Sector Público al Poder Estadal y al Poder Municipal por transferencia de servicios",1),
			("3","05","10","Transferencias y donaciones de Organismos del Sector Público a los Consejos Comunales",1),
			("3","06","01","Venta y/o desincorporación de activos fijos",1),
			("3","06","02","Venta de activos intangibles",1),
			("3","06","03","Incremento de la depreciación y amortización acumuladas",1),
			("3","07","01","Venta de títulos y valores de corto plazo",1),
			("3","07","02","Venta de títulos y valores de largo plazo",1),
			("3","08","01","Venta de acciones y participaciones de capital del sector privado",1),
			("3","08","02","Venta de acciones y participaciones de capital del sector público",1),
			("3","08","03","Venta de acciones y participaciones de capital del sector externo",1),
			("3","09","01","Recuperación de préstamos otorgados al sector privado de corto plazo",1),
			("3","09","02","Recuperación de préstamos otorgados al sector público de corto plazo",1),
			("3","09","03","Recuperación de préstamos otorgados al sector externo de corto plazo",1),
			("3","10","01","Recuperación de préstamos otorgados al sector privado de largo plazo",1),
			("3","10","02","Recuperación de préstamos otorgados al sector público de largo plazo",1),
			("3","10","03","Recuperación de préstamos otorgados al sector externo de largo plazo",1),
			("3","11","01","Disminución de disponibilidades",1),
			("3","11","02","Disminución de cuentas por cobrar a corto plazo",1),
			("3","11","03","Disminución de efectos por cobrar a corto plazo",1),
			("3","11","04","Disminución de cuentas por cobrar a mediano y largo plazo",1),
			("3","11","05","Disminución de efectos por cobrar a mediano y largo plazo",1),
			("3","11","06","Disminución de fondos en avance, anticipo y en fideicomiso",1),
			("3","11","07","Disminución de activos diferidos a corto plazo",1),
			("3","11","08","Disminución de activos diferidos a mediano y largo plazo",1),
			("3","11","09","Disminución del Fondo de Estabilización Macroeconómica (FEM)",1),
			("3","11","10","Disminución del Fondo de Ahorro Intergeneracional",1),
			("3","11","12","Disminución del Fondo de Aporte del Sector Público",1),
			("3","11","20","Disminución de activos en proceso judicial",1),
			("3","11","99","Disminución de otros activos financieros",1),
			("3","12","01","Incremento de gastos de personal por pagar",1),
			("3","12","02","Incremento de aportes patronales y retenciones laborales por pagar",1),
			("3","12","03","Incremento de cuentas y efectos por pagar a proveedores",1),
			("3","12","04","Incremento de cuentas y efectos por pagar a contratistas",1),
			("3","12","05","Incremento de intereses por pagar",1),
			("3","12","06","Incremento de otras cuentas y efectos por pagar",1),
			("3","12","07","Incremento de pasivos diferidos",1),
			("3","12","08","Incremento de provisiones y reservas técnicas",1),
			("3","12","09","Incremento de fondos de terceros",1),
			("3","12","10","Incremento de depósitos en instituciones financieras",1),
			("3","12","11","Reestructuración y/o refinanciamiento de la deuda pública",1),
			("3","12","99","Incremento de otros pasivos",1),
			("3","13","01","Incremento del capital",1),
			("3","13","02","Incremento de reservas",1),
			("3","13","03","Ajustes por inflación",1),
			("3","13","04","Incremento de resultados",1),
			("4","01","01","Sueldos, salarios y otras retribuciones",1),
			("4","01","02","Compensaciones previstas en las escalas de sueldos y salarios",1),
			("4","01","03","Primas",1),
			("4","01","04","Complementos de sueldos y salarios",1),
			("4","01","05","Aguinaldos, utilidades o bonificación legal, y bono vacacional",1),
			("4","01","06","Aportes patronales y legales",1),
			("4","01","07","Asistencia socio-económica",1),
			("4","01","08","Prestaciones sociales e indemnizaciones",1),
			("4","01","09","Capacitación y adiestramiento realizado por personal del organismo",1),
			("4","01","94","Otros gastos de los altos funcionarios y altas funcionarias del poder público y de elección popular",1),
			("4","01","95","Otros gastos del personal de alto nivel y de dirección",1),
			("4","01","96","Otros gastos del personal empleado",1),
			("4","01","97","Otros gastos del personal obrero",1),
			("4","01","98","Otros gastos del personal militar",1),
			("4","02","01","Productos alimenticios y agropecuarios",1),
			("4","02","02","Productos de minas, canteras y yacimientos",1),
			("4","02","03","Textiles y vestuarios",1),
			("4","02","04","Productos de cuero y caucho",1),
			("4","02","05","Productos de papel, cartón e impresos",1),
			("4","02","06","Productos químicos y derivados",1),
			("4","02","07","Productos minerales no metálicos",1),
			("4","02","08","Productos metálicos",1),
			("4","02","09","Productos de madera",1),
			("4","02","10","Productos varios y útiles diversos",1),
			("4","02","11","Bienes para la venta",1),
			("4","02","99","Otros materiales y suministros",1),
			("4","03","01","Alquileres de inmuebles",1),
			("4","03","02","Alquileres de maquinaria y equipos",1),
			("4","03","03","Derechos sobre bienes intangibles",1),
			("4","03","04","Servicios básicos",1),
			("4","03","05","Servicio de administración, vigilancia y mantenimiento de los servicios básicos",1),
			("4","03","06","Servicios de transporte y almacenaje",1),
			("4","03","07","Servicios de información, impresión y relaciones públicas",1),
			("4","03","08","Primas y otros gastos de seguros y comisiones bancarias",1),
			("4","03","09","Viáticos y pasajes",1),
			("4","03","10","Servicios profesionales, técnicos y demás oficios y ocupaciones",1),
			("4","03","11","Conservación y reparaciones menores de maquinaria y equipos",1),
			("4","03","12","Conservación y reparaciones menores de obras",1),
			("4","03","13","Servicios de construcciones temporales",1),
			("4","03","14","Servicios de construcción de edificaciones para la venta",1),
			("4","03","15","Servicios fiscales",1),
			("4","03","16","Servicios de diversión, esparcimiento y culturales",1),
			("4","03","17","Servicios de gestión administrativa prestados por organismos de asistencia técnica",1),
			("4","03","18","Impuestos indirectos",1),
			("4","03","19","Comisiones por servicios para cumplir con los beneficios sociales",1),
			("4","03","99","Otros servicios no personales",1),
			("4","04","01","Repuestos, reparaciones, mejoras y adiciones mayores",1),
			("4","04","02","Conservación, ampliaciones y mejoras mayores de obras",1),
			("4","04","03","Maquinaria y demás equipos de construcción, campo, industria y taller",1),
			("4","04","04","Equipos de transporte, tracción y elevación",1),
			("4","04","05","Equipos de comunicaciones y de señalamiento",1),
			("4","04","06","Equipos médico - quirúrgicos, dentales y de veterinaria",1),
			("4","04","07","Equipos científicos, religiosos, de enseñanza y recreación",1),
			("4","04","08","Equipos y armamentos de orden público, seguridad y defensa",1),
			("4","04","09","Máquinas, muebles y demás equipos de oficina y alojamiento",1),
			("4","04","10","Semovientes",1),
			("4","04","11","Inmuebles, maquinaria y equipos usados",1),
			("4","04","12","Activos intangibles",1),
			("4","04","13","Estudios y proyectos para inversión en activos fijos",1),
			("4","04","14","Contratación de inspección de obras",1),
			("4","04","15","Construcciones del dominio privado",1),
			("4","04","16","Construcciones del dominio público",1),
			("4","04","99","Otros activos reales",1),
			("4","05","01","Aportes en acciones y participaciones de capital",1),
			("4","05","02","Adquisición de títulos y valores que no otorgan propiedad",1),
			("4","05","03","Concesión de préstamos a corto plazo",1),
			("4","05","04","Concesión de préstamos a largo plazo",1),
			("4","05","05","Incremento de disponibilidades",1),
			("4","05","06","Incremento de cuentas por cobrar a corto plazo",1),
			("4","05","07","Incremento de efectos por cobrar a corto plazo",1),
			("4","05","08","Incremento de cuentas por cobrar a mediano y largo plazo",1),
			("4","05","09","Incremento de efectos por cobrar a mediano y largo plazo",1),
			("4","05","10","Incremento de fondos en avance, en anticipos y en fideicomiso",1),
			("4","05","11","Incremento de activos diferidos a corto plazo",1),
			("4","05","12","Incremento de activos diferidos a mediano y largo plazo",1),
			("4","05","13","Incremento del Fondo de Estabilización Macroeconómica (FEM)",1),
			("4","05","14","Incremento del Fondo de Ahorro Intergeneracional",1),
			("4","05","16","Incremento del Fondo de Aportes del Sector Público",1),
			("4","05","20","Incremento de otros activos financieros circulantes",1),
			("4","05","21","Incremento de otros activos financieros no circulantes",1),
			("4","05","99","Otros activos financieros",1),
			("4","06","01","Gastos de defensa y seguridad del Estado",1),
			("4","07","01","Transferencias y donaciones corrientes internas",1),
			("4","07","02","Transferencias y donaciones corrientes al exterior",1),
			("4","07","05","Situado",1),
			("4","07","06","Subsidio de Régimen Especial",1),
			("4","07","07","Subsidio de capitalidad",1),
			("4","07","08","Asignaciones Económicas Especiales (LAEE)",1),
			("4","07","09","Aportes al Poder Estadal y al Poder Municipal por transferencia de servicios",1),
			("4","07","10","Fondo Intergubernamental para la Descentralización (FIDES)",1),
			("4","07","11","Fondo de Compensación Interterritorial",1),
			("4","07","12","Transferencias y donaciones a Consejos Comunales",1),
			("4","08","01","Depreciación y amortización",1),
			("4","08","02","Intereses por operaciones financieras",1),
			("4","08","03","Gastos por operaciones de seguro",1),
			("4","08","04","Pérdida en operaciones de los servicios básicos",1),
			("4","08","05","Obligaciones en el ejercicio vigente",1),
			("4","08","06","Pérdidas ajenas a la operación",1),
			("4","08","07","Descuentos, bonificaciones y devoluciones",1),
			("4","08","08","Indemnizaciones y sanciones pecuniarias",1),
			("4","08","99","Otros gastos",1),
			("4","09","01","Asignaciones no distribuidas de la Asamblea Nacional",1),
			("4","09","02","Asignaciones no distribuidas de la Contraloría General de la República",1),
			("4","09","03","Asignaciones no distribuidas del Consejo Nacional Electoral",1),
			("4","09","04","Asignaciones no distribuidas del Tribunal Supremo de Justicia",1),
			("4","09","05","Asignaciones no distribuidas del Ministerio Público",1),
			("4","09","06","Asignaciones no distribuidas de la Defensoría del Pueblo",1),
			("4","09","07","Asignaciones no distribuidas del Consejo Moral Republicano",1),
			("4","09","08","Reestructuración de organismos del sector público",1),
			("4","09","09","Fondo de apoyo al trabajador y su grupo familiar",1),
			("4","09","10","Reforma de la seguridad social",1),
			("4","09","11","Emergencias en el territorio nacional",1),
			("4","09","12","Fondo para la cancelación de pasivos laborales",1),
			("4","09","13","Fondo para la cancelación de deuda por servicios de electricidad, teléfono, aseo, agua y condominio",1),
			("4","09","14","Fondo para remuneraciones, pensiones y jubilaciones y otras retribuciones",1),
			("4","09","15","Fondo para atender compromisos generados de la Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras",1),
			("4","09","16","Asignaciones para cancelar compromisos pendientes de ejercicios anteriores",1),
			("4","09","17","Asignaciones para cancelar la deuda Fogade – Ministerio competente en Materia de Finanzas – Banco Central de Venezuela (BCV)",1),
			("4","09","18","Asignaciones para atender los gastos de la referenda y elecciones",1),
			("4","09","19","Asignaciones para atender los gastos por honorarios profesionales de bufetes internacionales, costas y costos judiciales",1),
			("4","09","20","Fondo para atender compromisos generados por la contratación colectiva",1),
			("4","09","21","Proyecto social especial",1),
			("4","09","22","Asignaciones para programas y proyectos financiados con recursos de organismos multilaterales y/o bilaterales",1),
			("4","09","23","Asignación para facilitar la preparación de proyectos",1),
			("4","09","24","Programas de inversión para las entidades estadales, municipalidades y otras instituciones",1),
			("4","09","25","Cancelación de compromisos",1),
			("4","09","26","Asignaciones para atender gastos de los organismos del sector público",1),
			("4","09","27","Convenio de Cooperación Especial",1),
			("4","10","01","Servicio de la deuda pública interna a corto plazo",1),
			("4","10","02","Servicio de la deuda pública interna a largo plazo",1),
			("4","10","03","Servicio de la deuda pública externa a corto plazo",1),
			("4","10","04","Servicio de la deuda pública externa a largo plazo",1),
			("4","10","05","Reestructuración y/o refinanciamiento de la deuda publica",1),
			("4","10","06","Servicio de la deuda pública por obligaciones de ejercicios anteriores",1),
			("4","11","01","Disminución de gastos de personal por pagar",1),
			("4","11","02","Disminución de aportes patronales y retenciones laborales por pagar",1),
			("4","11","03","Disminución de cuentas y efectos por pagar a proveedores",1),
			("4","11","04","Disminución de cuentas y efectos por pagar a contratistas",1),
			("4","11","05","Disminución de intereses por pagar",1),
			("4","11","06","Disminución de otras cuentas y efectos por pagar a corto plazo",1),
			("4","11","07","Disminución de pasivos diferidos",1),
			("4","11","08","Disminución de provisiones y reservas técnicas",1),
			("4","11","10","Disminución de depósitos de instituciones financieras",1),
			("4","11","11","Obligaciones de ejercicios anteriores",1),
			("4","11","98","Disminución de otros pasivos a corto plazo",1),
			("4","12","01","Disminución del capital",1),
			("4","12","02","Disminución de reservas",1),
			("4","12","03","Ajuste por inflación",1),
			("4","12","04","Disminución de resultados",1),
			("4","98","01","Rectificaciones al presupuesto",1)')
		->execute();

		if(is_int($resultado)) //Insertados
		{
			echo "\033[32m ".$resultado." registros insertados con éxito.\033[0m\n";
		}
		
	}
}