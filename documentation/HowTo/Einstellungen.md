#2.1 Einstellungen

Da einige Einstellungen für alle Begriffe übergreifend funktionieren müssen, finden Sie in den Contao-Einstellungen ganz unten Einstellungsmöglichkeiten. Derzeit lassen sich zu ignorierende HTML-Tags und die Weiterleitungsseite definieren, die dann Standardmäßig für alle Begriffe gelten. Diese Einstellungen können aber in den Begriffseinstellungen selber überschrieben werden.

##2.1.1 Von der Suche ausgeschlossene Inhalte einbeziehen

Inhalte die von der Suche ausgeschlossen sind, werden standardmäßig nicht durchsucht. Diese Einstellung kann dies Ändern. Diese Option schließt zum Beispiel auch Module ein.

##2.1.2 Glossar Tags aktivieren

Diese Tags definieren dass der Glossar Inhalte ausschließt die mit `<!-- glossar::stop -->` und `<!-- glossar::continue -->` umschlossen wurden.

##2.1.3 Cache umgehen

Falls es weniger als zehn Begriffe auf einer Seite gibt, kann der Cache auch umgangen werden. Diese Option macht die Seite langsamer und sollte nur auf schnellen Servern verwendet werden. Allerdings muss der Cache mit dieser Version nicht nach jeder Inhaltsaktualisierung erneuert werden.

##2.1.4 Keine Fallback-Begriffe

Fallback-Begriffe werden aus Glossaren mit anderer Sprache als der aktuell angezeigten Seite aufgebaut. Wenn diese Option aktiviert ist, werden keine anderen Sprachen als Glossar-Link in den Inhalt geschrieben.

##2.1.5 Strikte Suche

Die Strikte suche definiert die Präzision mit der die Begriffe gesucht werden sollen. Prinzipiell werden alle Begriffe gesucht und eingetragen, aber je nach Auswahl dieser Option werden unterschiedliche Muster im Fronten benutzt um Begriffe zu finden.

##2.1.6 Tags ignorieren

Damit Begriffe nicht in Links, Scripten oder Style-Tags  ersetzt werden und den Ablauf der Seite stören, können diese Tags hier deaktiviert werden. Standardmäßig sind die wichtigsten Tags schon vordefiniert bei der Installation.

##2.1.7 Pluralsuche

Alle Sonderzeichen die nicht mehr zu einem Wort gehören können, werden hier definiert. Bis zu diesen Zeichen inklusive Leerzeichen, Slash, Backslash, Punkt und einigen weiteren Zeichen gilt ein Wort als Wort.

##2.1.8 Glossar-Seite

Alle Begriffe denen keine andere Weiterleitungsseite gegeben wird, werden auf die hier angegebe Seite weitergeleitet, wenn ein Benutzer sie anklickt.
