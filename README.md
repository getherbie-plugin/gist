# Herbie Gist Plugin

`Gist` ist ein [Herbie](http://github.com/getherbie/herbie) Plugin, mit dem du [Gist](https://gist.github.com)-Schnipsel 
von Github in deine Website einbettest.


## Installation

Das Plugin installierst du via Composer.

	$ composer require getherbie/plugin-gist

Danach aktivierst du das Plugin in der Konfigurationsdatei.

    plugins:
        enable:
            - gist


## Konfiguration

Unter `plugins.config.gist` stehen dir die folgenden Optionen zur Verfügung:

    # enable shortcode
    shortcode: true
    
    # enable twig function
    twig: false


## Anwendung

Mit dem Gist-Shortcode kannst du in Seiteninhalten jedes beliebige Gist-Schnipsel einbinden, wobei "123456789" die ID 
des gewünschten Gist ist.

    [gist 123456789]
    
    oder
    
    [gist id="123456789"]    

Möchtest du eine bestimmte Datei innerhalb eines Gist anzeigen, kannst Du dies mit dem optionalen `file`-Parameter 
machen: 

    [gist id="12345" file="filename.md"]
    
Mit dem Aktivieren der Twig-Funktion kannst du Gist-Schnipsel auch in Layoutdateien einsetzen:
     
    {{ gist id="123456789" }}    

    {{ gist id="12345" file="filename.md" }}


## Parameter

Name        | Beschreibung                              | Typ       | Default
:---------- | :-----------------------------------------| :-------- | :------
id          | Die Gist-ID                               | string    |  *empty*
file        | Eine bestimmte Datei innerhalb des Gist   | string    |  *empty*


## Demo

<https://herbie.tebe.ch/dokumentation/plugins/gist>
