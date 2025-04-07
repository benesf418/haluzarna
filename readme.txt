je to v textaku pac to mrdam

______________struktura db______________

users
- id
- name
- password
- balance

matches
- id
- name

betGroups           predstavuje sazku v ramci zapasu. Ma pod sebou vetsinou dve sazky, jednu pro kazdeho zapasnika
- id
# matchId
- name

bets                jednotlive moznosti na co jde vsadit v ramci jedne matchBetGroupy        
- id
# betGroupId
- name
- available         dovoli to uzivateli na tohle vsadit?
- wasCorrect        v zakladu null, po uzavreni dane matchBetGroupy true/false

courses
- id
# betId
- course
- createdAt

userBets            toto jsou realne sazky ktere zada uzivatel
- id
# userId
# betId
- amount


______________usecases______________
admin:
- pridani balancu uzivateli
- vytvoreni matche
- vytvoreni sazky pro match
    - matchBetGroup 
    - betOptions 
    - pocatecni kurz
- uprava kurzu pro existujici betOptiony

uzivatel:
- vytvoreni uctu
- prihlaseni
- zobrazeni zapasu
- zobrazeni detailu zapasu (viditelne sazky)
- zadani sazky
- zobrazeni historie jeho sazek