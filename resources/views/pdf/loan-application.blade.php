<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Application - {{ $application->id ?? 'Draft' }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; line-height: 1.5; font-size: 14px; }
        .header { text-align: center; border-bottom: 2px solid #4F46E5; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #4F46E5; margin-bottom: 5px; }
        .subtitle { font-size: 16px; color: #666; }
        .section-title { background: #f3f4f6; padding: 10px; font-weight: bold; margin: 20px 0 10px; border-left: 4px solid #4F46E5; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { width: 40%; color: #666; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">MURANG'A WOMEN'S SACCO</div>
        <div class="subtitle">Official Loan Application Document</div>
        <div style="margin-top: 10px; font-size: 12px; color: #999;">Date: {{ \Carbon\Carbon::parse($application->application_date ?? now())->format('F j, Y') }}</div>
    </div>

    <div class="section-title">1. Member Details</div>
    <table>
        <tr>
            <th>Full Name:</th>
            <td>{{ $member->user->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Member Number:</th>
            <td>{{ $member->member_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td>{{ $member->user->phone ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-title">2. Loan Information</div>
    <table>
        <tr>
            <th>Loan Product:</th>
            <td>{{ $application->loanProduct->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Amount Requested (KES):</th>
            <td><strong>{{ number_format($application->amount_requested ?? 0, 2) }}</strong></td>
        </tr>
        <tr>
            <th>Repayment Period:</th>
            <td>{{ $application->period_months ?? 0 }} Months</td>
        </tr>
        <tr>
            <th>Purpose:</th>
            <td>{{ $application->purpose ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-title">3. Signatures & Approvals</div>
    <div style="margin-top: 30px;">
        <p>I confirm that all information provided above is correct and agree to the SACCO loan terms and conditions.</p>
        <table style="margin-top: 40px;">
            <tr>
                <td style="border: none; text-align: center;">
                    ___________________________<br><br>
                    <strong>Applicant Signature</strong>
                </td>
                <td style="border: none; text-align: center;">
                    ___________________________<br><br>
                    <strong>Date</strong>
                </td>
            </tr>
        </table>
    </div>
    
    <div style="margin-top: 40px; border: 2px dashed #ccc; padding: 20px;">
        <strong>Official Use Only</strong>
        <p>Status: {{ strtoupper($application->status ?? 'PENDING') }}</p>
        <p>Reviewed By: ___________________________</p>
        <p>Date: ___________________________</p>
    </div>

    <div class="footer">
        Murang'a County Women's SACCO • PO Box 123, Murang'a • info@mwsacco.co.ke
    </div>
</body>
</html>
