(function () {
  'use strict';
  /*globals location, XMLHttpRequest, setTimeout*/
  var loc     = location; 
  var host    = loc.hostname + (loc.port ? ':' + loc.port : '');
  var timeout = setTimeout;
  var time_of_load, check, xhr, lastModified, time_modif;
  if (loc.host === host) {
    time_of_load= new Date().getTime();
	time_of_load= time_of_load.toString().slice(0,-3);
    check = function () {
      xhr = new XMLHttpRequest();
      xhr.onload = function () {
        lastModified = this.getResponseHeader('Last-Modified');
        // time_modif = new Date(lastModified).getTime();
		console.log(lastModified + ' ' + time_of_load);
        if (lastModified > time_of_load) {
          loc.reload();
        } else {
          timeout(check, 3000);
        }
      };
      xhr.open('HEAD', loc.href + '?t=' + new Date().getTime(), true);
      xhr.setRequestHeader('pragma', 'no-cache');
      xhr.send();
    };
    timeout(check, 3000);
  }
}());
