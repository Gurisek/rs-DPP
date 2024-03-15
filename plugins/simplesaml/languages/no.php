<?php


$lang["simplesaml_configuration"]='Enkel konfigurasjon av SimpleSAML.';
$lang["simplesaml_main_options"]='Bruksalternativer.';
$lang["simplesaml_site_block"]='Bruk SAML for å blokkere tilgang til nettstedet fullstendig. Hvis satt til "true", kan ingen få tilgang til nettstedet, selv ikke anonymt, uten å autentisere seg.';
$lang["simplesaml_allow_public_shares"]='Hvis blokkering av nettstedet, tillate at offentlige delinger kan omgå SAML-autentisering?';
$lang["simplesaml_allowedpaths"]='Liste over ekstra tillatte stier som kan omgå SAML-kravet.';
$lang["simplesaml_allow_standard_login"]='Tillat brukere å logge inn med standardkontoer samt bruke SAML SSO? ADVARSEL: Å deaktivere dette kan risikere å låse alle brukere ut av systemet hvis SAML-autentisering mislykkes.';
$lang["simplesaml_use_sso"]='Bruk SSO for å logge inn.';
$lang["simplesaml_idp_configuration"]='IdP konfigurasjon';
$lang["simplesaml_idp_configuration_description"]='Bruk følgende for å konfigurere tillegget slik at det fungerer med din IdP.';
$lang["simplesaml_username_attribute"]='Attributt(er) som skal brukes for brukernavn. Hvis dette er en sammenslåing av to attributter, vennligst separer med komma.';
$lang["simplesaml_username_separator"]='Hvis du slår sammen feltene for brukernavn, bruk dette tegnet som skilletegn.';
$lang["simplesaml_fullname_attribute"]='Attributt(er) som skal brukes for fullt navn. Hvis dette er en sammenslåing av to attributter, vennligst separer med komma.';
$lang["simplesaml_fullname_separator"]='Hvis du slår sammen feltene for fullt navn, bruk dette tegnet som skilletegn.';
$lang["simplesaml_email_attribute"]='Attributt å bruke for e-postadresse.';
$lang["simplesaml_group_attribute"]='Attributt som brukes til å bestemme gruppetilhørighet.';
$lang["simplesaml_username_suffix"]='Tillegg til å legge til på brukernavn som er opprettet for å skille dem fra standard ResourceSpace-kontoer.';
$lang["simplesaml_update_group"]='Oppdater brukergruppe ved hver pålogging. Hvis du ikke bruker SSO-gruppeattributtet for å bestemme tilgang, sett dette til "false" slik at brukere kan flyttes manuelt mellom grupper.';
$lang["simplesaml_groupmapping"]='SAML - Kartlegging av ResourceSpace-grupper';
$lang["simplesaml_fallback_group"]='Standard brukergruppe som vil bli brukt for nylig opprettede brukere.';
$lang["simplesaml_samlgroup"]='SAML-gruppe.';
$lang["simplesaml_rsgroup"]='ResourceSpace Gruppe';
$lang["simplesaml_priority"]='Prioritet (høyere tall vil ha forrang)';
$lang["simplesaml_addrow"]='Legg til kartlegging.';
$lang["simplesaml_service_provider"]='Navn på lokal tjenestetilbyder (SP)';
$lang["simplesaml_prefer_standard_login"]='Foretrekk standard pålogging (videresend til påloggingssiden som standard)';
$lang["simplesaml_sp_configuration"]='Konfigurasjonen av simplesaml SP må fullføres for å bruke denne plugin-modulen. Vennligst se Kunnskapsbasen for mer informasjon.';
$lang["simplesaml_custom_attributes"]='Tilpassede attributter for å registrere mot brukeroppføringen.';
$lang["simplesaml_custom_attribute_label"]='SSO-attributt';
$lang["simplesaml_usercomment"]='Opprettet av SimpleSAML-tillegget.';
$lang["origin_simplesaml"]='SimpleSAML-tillegg';
$lang["simplesaml_lib_path_label"]='SAML bibliotekbane (angi full serverbane)';
$lang["simplesaml_login"]='Bruk SAML- legitimasjon for å logge inn på ResourceSpace? (Dette er bare relevant hvis ovennevnte alternativ er aktivert)';
$lang["simplesaml_create_new_match_email"]='E-post-samsvar: Før du oppretter nye brukere, sjekk om SAML-brukerens e-post samsvarer med en eksisterende RS-konto-e-post. Hvis det finnes en match, vil SAML-brukeren \'adoptere\' den kontoen.';
$lang["simplesaml_allow_duplicate_email"]='Tillat opprettelse av nye kontoer hvis det finnes eksisterende ResourceSpace-kontoer med samme e-postadresse? (dette overstyrer hvis e-post-samsvar er satt over og det finnes ett samsvar)';
$lang["simplesaml_multiple_email_match_subject"]='ResourceSpace SAML - konfliktende e-post påloggingsforsøk.';
$lang["simplesaml_multiple_email_match_text"]='En ny SAML-bruker har fått tilgang til systemet, men det finnes allerede mer enn én konto med samme e-postadresse.';
$lang["simplesaml_multiple_email_notify"]='E-postadresse for å varsle hvis det oppdages en e-postkonflikt.';
$lang["simplesaml_duplicate_email_error"]='Det finnes allerede en konto med samme e-postadresse. Vennligst kontakt administratoren din.';
$lang["simplesaml_usermatchcomment"]='Oppdatert til SAML-bruker av SimpleSAML-tillegget.';
$lang["simplesaml_usercreated"]='Opprettet ny SAML-bruker.';
$lang["simplesaml_duplicate_email_behaviour"]='Administrasjon av dupliserte kontoer.';
$lang["simplesaml_duplicate_email_behaviour_description"]='Denne delen styrer hva som skjer hvis en ny SAML-bruker som logger inn, kommer i konflikt med en eksisterende konto.';
$lang["simplesaml_authorisation_rules_header"]='Autorisasjonsregel.';
$lang["simplesaml_authorisation_rules_description"]='Tillat at ResourceSpace kan konfigureres med ekstra lokal autorisasjon av brukere basert på en ekstra attributt (dvs. påstand/krav) i responsen fra IdP. Denne påstanden vil bli brukt av tillegget for å avgjøre om brukeren har tillatelse til å logge inn på ResourceSpace eller ikke.';
$lang["simplesaml_authorisation_claim_name_label"]='Attributt (påstand/navn) navn.';
$lang["simplesaml_authorisation_claim_value_label"]='Attributtverdi (påstand/krav-verdi)';
$lang["simplesaml_authorisation_login_error"]='Du har ikke tilgang til denne applikasjonen! Vennligst kontakt administratoren for din konto!';
$lang["simplesaml_authorisation_version_error"]='VIKTIG: Konfigurasjonen din for SimpleSAML må oppdateres. Se seksjonen \'<a href=\'https://www.resourcespace.com/knowledge-base/plugins/simplesaml#saml_instructions_migrate\' target=\'_blank\'> Migrering av SP for å bruke ResourceSpace-konfigurasjon</a>\' i kunnskapsbasen for mer informasjon.';
$lang["simplesaml_healthcheck_error"]='EnkelSAML-tilleggsfeil.';
$lang["simplesaml_rsconfig"]='Bruk standard ResourceSpace konfigurasjonsfiler for å sette SP konfigurasjon og metadata? Hvis dette er satt til false, kreves manuell redigering av filer.';
$lang["simplesaml_sp_generate_config"]='Generer SP-konfigurasjon.';
$lang["simplesaml_sp_config"]='Tjenestetilbyder (TP) konfigurasjon.';
$lang["simplesaml_sp_data"]='Tjenestetilbyder (TP) informasjon.';
$lang["simplesaml_idp_section"]='IdP (Identity Provider) = Identitetstilbyder';
$lang["simplesaml_idp_metadata_xml"]='Lim inn IdP Metadata XML-en.';
$lang["simplesaml_sp_cert_path"]='Sti til SP-sertifikatfil (la tom for å generere, men fyll inn sertifikatdetaljer nedenfor)';
$lang["simplesaml_sp_key_path"]='Sti til SP nøkkelfil (.pem) (la stå tom for å generere)';
$lang["simplesaml_sp_idp"]='IdP identifikator (la tomt hvis XML behandles)';
$lang["simplesaml_saml_config_output"]='Lim inn dette i konfigurasjonsfilen til ResourceSpace.';
$lang["simplesaml_sp_cert_info"]='Sertifikatinformasjon (påkrevd)';
$lang["simplesaml_sp_cert_countryname"]='Landkode (kun 2 tegn)';
$lang["simplesaml_sp_cert_stateorprovincename"]='Stat, fylkesnavn eller provinsnavn.';
$lang["simplesaml_sp_cert_localityname"]='Område (f.eks. by/sted)';
$lang["simplesaml_sp_cert_organizationname"]='Organisasjonsnavn';
$lang["simplesaml_sp_cert_organizationalunitname"]='Organisasjonsenhet / avdeling';
$lang["simplesaml_sp_cert_commonname"]='Vanlig navn (f.eks. sp.acme.org)';
$lang["simplesaml_sp_cert_emailaddress"]='E-postadresse.';
$lang["simplesaml_sp_cert_invalid"]='Ugyldig sertifikatinformasjon.';
$lang["simplesaml_sp_cert_gen_error"]='Kan ikke generere sertifikat.';
$lang["simplesaml_sp_technicalcontact_name"]='Teknisk kontaktnavn';
$lang["simplesaml_sp_technicalcontact_email"]='Teknisk kontakt-e-post.';
$lang["simplesaml_sp_auth.adminpassword"]='SP Test nettsted administrator passord.';
$lang["simplesaml_entity_id"]='Entitets-ID/metadata-URL';
$lang["simplesaml_single_logout_url"]='Enkel utlogging URL';
$lang["simplesaml_start_url"]='Start/Påloggings-URL';
$lang["simplesaml_existing_config"]='Følg instruksjonene i Kunnskapsbasen for å migrere din eksisterende SAML-konfigurasjon.';
$lang["simplesaml_test_site_url"]='EnkelSAML testnettstedets URL';
$lang["simplesaml_sp_samlphp_link"]='Besøk SimpleSAMLphp testnettsted.';