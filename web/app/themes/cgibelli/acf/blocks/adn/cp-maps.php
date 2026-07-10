
<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-map.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyB-5IUvwtncbrYVKOALxInF91-amipA_YU&libraries=geometry,places&" type="text/javascript"></script>
<div class="teq-container cp-maps pt-5">
    <div class="teq-row max-w">
        <div class="col-12 relative">
            <div class="absolute bg-white c-dark pl-2 pr-2 pb-2 pt-2  container ">
                <div class="d-flex gap-10 check-container ">
                    <div><input type="checkbox" id="test1" value="Huiles d'olives" name="test1" class="input-map"> <label for="test1">Huile d'olive</label></div>
                    <div><input type="checkbox" id="test2" value="Olives de tables" name="test2" class="input-map"> <label for="test2">Olives de tables</label></div>
                </div>
            </div>
            <div id="map" class="relative" style="height: 600px; width:100%"></div>
            
        </div>
    </div>
</div>

<script>
    window.data = [
// couleur principale
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#b0a6a6"
      }
    ]
  },
  //couleur frontière pays
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#ffffff"
      },
      {
        "weight": 2
      }
    ]
  },
  //couleur pays
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#FFFFFF"
      }
    ]
  },
  // bordure couleur pays
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#242f3e"
      }
    ]
  },
  // couleur ville
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#daf609"
      }
    ]
  },
  // couleur points interêts (mairie ...)
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  // PARC
  // couleur parc
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#263c3f"
      }
    ]
  },
  // couleur texte parc 
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#6b9a76"
      }
    ]
  },
  // ROUTES
  // couleur toutes les routes
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#0ced5b"
      }
    ]
  },
  // couleurs bordure route
  {
    "featureType": "road",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#212a37"
      }
    ]
  },
  // couleur texte route
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9ca5b3"
      }
    ]
  },
  // couleur autoroute
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#2864F0"
      }
    ]
  },
  // couleur bordure autoroute
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#5697f0"
      }
    ]
  },
  // couleur texte autoroute
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#f3d19c"
      }
    ]
  },
  // couleur ligne de train 
  {
    "featureType": "transit",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#2f3948"
      }
    ]
  },
  // couleur aeroport train bus 
  {
    "featureType": "transit.station",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  // MAPS 
  // Couleur de l'eau
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#989ba0"
      },
      {
        "saturation": -35
      },
      {
        "lightness": -60
      }
    ]
  },
  // couleur fond texte
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#515c6d"
      }
    ]
  },
  // couleur bordure texte
  {
    "featureType": "water",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#17263c"
      }
    ]
  }
]
</script>