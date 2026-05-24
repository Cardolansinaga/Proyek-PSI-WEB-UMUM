<style>
    /* Admin Enhanced Styling & Animations */
    
    /* Scrollbar Styling */
    .main-content {
        scrollbar-width: thin;
        scrollbar-color: #d6a63a #f8fafc;
    }
    
    .main-content::-webkit-scrollbar {
        width: 8px;
    }
    
    .main-content::-webkit-scrollbar-track {
        background: #f8fafc;
    }
    
    .main-content::-webkit-scrollbar-thumb {
        background: #d6a63a;
        border-radius: 10px;
    }
    
    .main-content::-webkit-scrollbar-thumb:hover {
        background: #c9962c;
    }

    /* Page Head Animation */
    .page-head {
        animation: slideInDown 0.5s ease-out;
    }
    
    .page-head h1 {
        background: linear-gradient(135deg, #071f3a 0%, #0f5a7a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Card Styling Enhancements */
    .card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(7, 31, 58, 0.08);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #d6a63a, #071f3a);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(7, 31, 58, 0.15);
        border-color: #d6a63a;
    }

    .card:hover::before {
        opacity: 1;
    }

    .card h2,
    .card h3 {
        color: #071f3a;
        font-weight: 900;
    }

    /* Input Styling */
    .custom-input,
    .custom-select,
    .custom-textarea {
        border: 1px solid #d9e1ec;
        border-radius: 10px;
        padding: 12px 14px;
        font: inherit;
        color: #071f3a;
        background: #ffffff;
        transition: all 0.3s ease;
    }

    .custom-input:focus,
    .custom-select:focus,
    .custom-textarea:focus {
        border-color: #d6a63a;
        box-shadow: 0 0 0 3px rgba(214, 166, 58, 0.1);
        outline: none;
    }

    .custom-input:hover,
    .custom-select:hover,
    .custom-textarea:hover {
        border-color: #c9962c;
    }

    /* Button Enhancements */
    .btn-primary,
    .btn-outline {
        border-radius: 10px;
        padding: 12px 18px;
        font-weight: 900;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary {
        background: linear-gradient(135deg, #071f3a, #0f5a7a);
        color: white;
        border: 1px solid #071f3a;
        box-shadow: 0 4px 15px rgba(7, 31, 58, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(7, 31, 58, 0.3);
    }

    .btn-outline {
        background: white;
        color: #071f3a;
        border: 1px solid #d9e1ec;
        box-shadow: 0 2px 8px rgba(7, 31, 58, 0.06);
    }

    .btn-outline:hover {
        background: #f8fafc;
        border-color: #c9962c;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(7, 31, 58, 0.1);
    }

    /* Status Cards */
    .status-card {
        background: linear-gradient(135deg, #071f3a 0%, #0f5a7a 100%);
        color: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 8px 25px rgba(7, 31, 58, 0.12);
        position: relative;
        overflow: hidden;
        animation: slideInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .status-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(214, 166, 58, 0.1) 0%, transparent 70%);
    }

    .status-card > * {
        position: relative;
        z-index: 1;
    }

    .status-card strong {
        display: block;
        font-size: 28px;
        font-weight: 900;
    }

    .status-card small {
        display: block;
        margin-top: 8px;
        color: rgba(255, 255, 255, 0.75);
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .status-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .status-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .status-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    /* Overview Grid Cards */
    .overview-grid .card {
        animation: slideInUp 0.6s ease-out both;
    }

    .overview-grid .card:nth-child(1) {
        animation-delay: 0.2s;
    }

    .overview-grid .card:nth-child(2) {
        animation-delay: 0.3s;
    }

    .overview-grid .card:nth-child(3) {
        animation-delay: 0.4s;
    }

    .overview-grid .card:nth-child(4) {
        animation-delay: 0.5s;
    }

    /* Module Grid */
    .module-grid .card:nth-child(1) {
        animation: slideInUp 0.6s ease-out 0.5s both;
    }

    .module-grid .card:nth-child(2) {
        animation: slideInUp 0.6s ease-out 0.6s both;
    }

    .module-grid .card:nth-child(3) {
        animation: slideInUp 0.6s ease-out 0.7s both;
    }

    .module-grid .card:nth-child(4) {
        animation: slideInUp 0.6s ease-out 0.8s both;
    }

    .module-grid .card:nth-child(5) {
        animation: slideInUp 0.6s ease-out 0.9s both;
    }

    /* Icon Badges */
    .card span {
        display: inline-grid;
        place-items: center;
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, #d6a63a 0%, #c9962c 100%);
        color: #071f3a;
        font-weight: 900;
        margin-bottom: 18px;
        font-size: 24px;
        transition: transform 0.3s ease;
    }

    .card:hover span {
        transform: scale(1.1);
    }

    /* Status Pill */
    .status-pill {
        display: inline-flex;
        border-radius: 999px;
        padding: 6px 12px;
        background: #ecfdf5;
        color: #166534;
        font-size: 11px;
        font-weight: 900;
        animation: slideInRight 0.4s ease-out;
    }

    /* Content List */
    .content-list {
        display: grid;
        gap: 12px;
    }

    .content-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 14px;
        align-items: center;
        border: 1px solid #edf2f7;
        border-radius: 10px;
        padding: 14px;
        background: #fbfdff;
        transition: all 0.25s ease;
    }

    .content-row:hover {
        background: #f8fafc;
        border-color: #d6a63a;
        transform: translateX(4px);
    }

    .content-row strong {
        color: #071f3a;
        display: block;
    }

    .content-row span {
        color: #64748b;
        font-size: 12px;
    }

    /* Note Box */
    .note {
        border-left: 4px solid #d6a63a;
        background: #fff8e7;
        padding: 14px;
        border-radius: 10px;
        color: #7c5a10;
        font-size: 13px;
        line-height: 1.6;
        animation: slideInLeft 0.4s ease-out;
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Gradient Background for Body */
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
    }

    /* Field Group Label Enhancement */
    .input-group label {
        font-size: 11px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Stack and Grid Helpers */
    .stack {
        display: grid;
        gap: 18px;
    }

    .field-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    @media (max-width: 1080px) {
        .field-grid,
        .overview-grid,
        .management-grid,
        .module-grid {
            grid-template-columns: 1fr;
        }

        .page-head {
            flex-direction: column;
        }

        .card span {
            width: 44px;
            height: 44px;
            font-size: 20px;
        }
    }

    @media (max-width: 640px) {
        .page-head h1 {
            font-size: 24px;
        }

        .btn-primary,
        .btn-outline {
            width: 100%;
            text-align: center;
        }
    }
</style>
