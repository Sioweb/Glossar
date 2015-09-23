#2.1 Einstellungen

Da einige Einstellungen für alle Begriffe übergreifend funktionieren müssen, finden Sie in den Contao-Einstellungen ganz unten Einstellungsmöglichkeiten. Derzeit lassen sich zu ignorierende HTML-Tags und die Weiterleitungsseite definieren, die dann Standardmäßig für alle Begriffe gelten. Diese Einstellungen können aber in den Begriffseinstellungen selber überschrieben werden.

![Einstellungen > Glossar Einstellungen](https://raw.githubusercontent.com/kbits/SWGlossar/kbits_doku_swglossar/documentation/images/Einstellungen.PNG)

##2.1.1 Glossar aktivieren:
Wird generell der Glossar deaktiviert, dann ist die Funktionalität des Mouse-Over deaktiviert. 
In der Systemwartung ist der Glossar Index Aufbau nicht mehr vorhanden.

Wurde bereits ein Glossar aufgebaut, bleiben die Links erhalten. Erst nachdem in der Systemwartung „Glossar zurücksetzen“ durchgeführt wurde, sind die Glossareinträge weg.
ACHTUNG: Das Glossar muss danach wieder neu aufgebaut werden.

##2.1.2 Glossar in der Systemwartung/Daten bereinigen anzeigen
Der Glossar kann im Bereich "Daten bereinigen" ausgegeben werden. Diese Option verhindert dass der Glossar versehentlich geleert wird.

##2.1.3 Begriffe als Headline aktivieren
Im Glossar definierte Begriffe werden in der Auflistung als Überschrift verwendet, wenn kein Überschrift-Element eingebunden wird.

##2.1.4 Pluralsuche deaktivieren
Pluralsuche bedeutet, dass der Begriff am Wortbeginn bis das Wortende gefunden wird. Als Beispiel **Bad**emeister 

##2.1.5 Von der Suche ausgeschlossene Inhalte einbeziehen
Inhalte die von der Suche ausgeschlossen sind, werden standardmäßig nicht durchsucht. Diese Einstellung kann dies Ändern. Diese Option schließt zum Beispiel auch Module ein.

##2.1.6 Glossar Tags aktivieren
Diese Tags definieren dass der Glossar Inhalte ausschließt die mit `<!-- glossar::stop -->` und `<!-- glossar::continue -->` umschlossen wurden.

##2.1.7 Cache umgehen
Falls es weniger als zehn Begriffe auf einer Seite gibt, kann der Cache auch umgangen werden. Diese Option macht die Seite langsamer und sollte nur auf schnellen Servern verwendet werden. Allerdings muss der Cache mit dieser Version nicht nach jeder Inhaltsaktualisierung erneuert werden.

##2.1.8 Keine fremdsprachigen Glossare
Fallback-Begriffe werden aus Glossaren mit anderer Sprache als der aktuell angezeigten Seite aufgebaut. Wenn diese Option aktiviert ist, werden keine anderen Sprachen als Glossar-Link in den Inhalt geschrieben.

##2.1.9 Archive ausschließen
Hier können Archive wie z.B. News, FAQ oder Events aus dem Glossar ausgeschlossen werden. 

##2.1.10 Strikte Suche
Die Strikte suche definiert die Präzision mit der die Begriffe gesucht werden sollen. Prinzipiell werden alle Begriffe gesucht und eingetragen, aber je nach Auswahl dieser Option werden unterschiedliche Muster im Fronten benutzt um Begriffe zu finden. Es sind folgende Einstellungen möglich:
-	Nur alleinstehende Wörter finden (Im schwimmer Becken)
-	Alles finden (Im Schwimmerbecken, im schwimmer Becken, nicht|schwimmer|becken)
-	Begriff kann das Startwort sein (Im Schwimmer|becken, im schwimmer Becken)

##2.1.11 Maximale Vorschaubreite
Definiert die Breite des Vorschaufenster, wenn ein Besucher mit der Maus über den Begriff fahren.

##2.1.12 Maximale Vorschauhöhe
Definiert die Höhe des Vorschaufenster, wenn ein Besucher mit der Maus über den Begriff fahren.

##2.1.13 Tags ignorieren
Damit Begriffe nicht in Links, Scripten oder Style-Tags  ersetzt werden und den Ablauf der Seite stören, können diese Tags hier deaktiviert werden. Standardmäßig sind die wichtigsten Tags schon vordefiniert bei der Installation.

##2.1.14 Pluralsuche
Alle Sonderzeichen die nicht mehr zu einem Wort gehören können, werden hier definiert. Bis zu diesen Zeichen inklusive Leerzeichen, Slash, Backslash, Punkt und einigen weiteren Zeichen gilt ein Wort als Wort.

##2.1.8 Glossar-Seite

Alle Begriffe denen keine andere Weiterleitungsseite gegeben wird, werden auf die hier angegebe Seite weitergeleitet, wenn ein Benutzer sie anklickt.
