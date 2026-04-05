<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - {{ $contact->prenom }} {{ $contact->nom }}</title>
    <style>
        @page {
            margin: 20px;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
            font-size: 12px;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header p {
            margin: 3px 0;
            color: #666;
            font-size: 11px;
        }
        
        .contact-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        
        .contact-name {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #007bff;
        }
        
        .info-row {
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 6px;
            padding-top: 2px;
        }
        
        .info-label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            width: 100px;
            vertical-align: top;
            text-transform: uppercase;
            font-size: 11px;
        }
        
        .info-value {
            color: #212529;
            display: inline-block;
            width: calc(100% - 110px);
            word-wrap: break-word;
        }
        
        .note-section {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .note-title {
            font-weight: bold;
            color: #856404;
            margin-bottom: 8px;
            font-size: 13px;
            text-transform: uppercase;
        }
        
        .note-content {
            color: #856404;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 11px;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }
        
        .empty-value {
            color: #6c757d;
            font-style: italic;
        }
        
        .logo-section {
            float: right;
            width: 80px;
            height: 60px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            text-align: center;
            line-height: 60px;
            color: #6c757d;
            font-size: 10px;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-section">
            <i class="fas fa-address-book"></i>
        </div>
        <h1>FICHE CONTACT</h1>
        <p>Exporté le {{ date('d/m/Y à H:i') }}</p>
    </div>

    <div class="contact-info">
        <div class="contact-name">
            {{ $contact->prenom }} {{ $contact->nom }}
        </div>

        <div class="info-row">
            <span class="info-label">Email :</span>
            <span class="info-value">
                @if($contact->email)
                    {{ $contact->email }}
                @else
                    <span class="empty-value">Non renseigné</span>
                @endif
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">Téléphone :</span>
            <span class="info-value">
                @if($contact->telephone)
                    {{ $contact->telephone }}
                @else
                    <span class="empty-value">Non renseigné</span>
                @endif
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">Adresse :</span>
            <span class="info-value">
                @if($contact->adresse)
                    {{ $contact->adresse }}
                @else
                    <span class="empty-value">Non renseignée</span>
                @endif
            </span>
        </div>

        @if($contact->categorie)
        <div class="info-row">
            <span class="info-label">Catégorie :</span>
            <span class="info-value">{{ $contact->categorie }}</span>
        </div>
        @endif

        <div class="info-row">
            <span class="info-label">Créé le :</span>
            <span class="info-value">{{ $contact->created_at->format('d/m/Y à H:i') }}</span>
        </div>

        @if($contact->updated_at && $contact->updated_at != $contact->created_at)
        <div class="info-row">
            <span class="info-label">Modifié le :</span>
            <span class="info-value">{{ $contact->updated_at->format('d/m/Y à H:i') }}</span>
        </div>
        @endif
    </div>

    @if($contact->note)
    <div class="note-section">
        <div class="note-title">NOTES :</div>
        <div class="note-content">{{ $contact->note }}</div>
    </div>
    @endif

    <div class="footer">
        <p><strong>Système de Gestion des Contacts</strong></p>
        <p>Contact : {{ $contact->prenom }} {{ $contact->nom }} • Exporté le {{ date('d/m/Y à H:i') }}</p>
    </div>
</body>
</html>
