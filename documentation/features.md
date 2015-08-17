#3 Features

- Mehrsprachigkeit
- Caching für sehr viele Begriffe
- Umfangreiche globale und individuelle Einstellungen
- Ajax-Vorschau bei Mausover
- Zusatz-Inhalte wie News, FAQ und Events werden durchsucht
- Eine ganze Reihe Hooks für mehr individualisierung
- Glossar-Tag-Cloud
- Einfache Suche, strikte Suche und oder Pluralsuche
- Individuelle Weiterleitungsseite für Begriffe
- Detailseiten bekommen Begriff auf Wunsch automatisch als Überschrift
- Spezielle HTML-Tags von der Suche ausschließen

##3.1 Mehrsprachigkeit

Um zukünftig updatefähig und flexibel bleiben zu können, werden alle Glossare in einem Container bzw. Glossar gespeichert. Der Glossar dient als Filter für Sprachen oder auch als Filter für unterschiedliche Seitenbäume. 

Jeder Glossar durchsucht auch fremde Sprachen nach seinen Begriffen, diese können dann als Fallback-Artikel markiert werden.

##3.2 Caching

Eine Seite bei jedem Aufruf mit 30 bis 2000 zu durchsuchen kostet viel Zeit. Damit der Glossar die Seite nicht unnötig langsam macht, kann der Glossar in der Systemwartung generiert werden. Jede Seite, News, FAQ und jedes Event wird dann durchsucht. Alle gefundenen Begriffe werden dann in der jeweiligen Tabelle gespeichert. So müssen pro Seite nur noch wenige Begriffe berücksichtigt werden.

**Der Cache kann in den Systemeinstellungen geleert werden**

##3.3 Ajax-Vorschau

Jeder Begriff der auch weitere Inhalte enthält wird als Link ersetzt. Alle anderen als Html-Container. Beide Versionen zeigen dem Besucher nach kurzer Zeit eine Vorschau mit den Teaser-Inhalten des Begriffes. Dadurch kann der Besucher schnell mehr Informationen bekommen und bei Bedarf auf die Detailseite wechseln.

##3.4 Begriff-Suche

Es ist möglich zu definieren, wie die Begriffe im Inhalt durchsucht werden sollen. Sollen nur alleistehende Wörter gefunden werden? Beispiele:


**Wort: Bad**

Pluralsuche findet die Wörter `bad, Bad,bademeister,baden, etc`  
Strikte Suche findet nur `bad`  
Suche ersetzt nur den ersten Teil eines Wortes `Bad`-emeister
