$(document).ready(function(){$("#myInput").on("keyup",function(){var t=$(this).val().toLowerCase();$("#tablex tr").filter(function(){$(this).toggle($(this).text().toLowerCase().indexOf(t)>-1)})})});