select id, fecha_sis, info_regional, info_cde,
 ph_ase_total, ph_ase_segturno, ph_ase_compensando, ph_ase_incapacitados,
ph_ase_ausente, ph_ase_vacaciones, ph_incap, ph_comp, info_observaciones
from cocinfo.u_dmsapertura
where info_canal = 'TIENDAS PROPIAS'
and fecha_apertura = '2014-01-30'
AND PH_ASE_COMPENSANDO != ''