<!-- ================= STYLES ================= -->
<style>
          .seller-logo-letter {
   display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    font-weight: bold;
    text-transform: uppercase;
}
        .card-listingpage {
      width: fit-content;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px 20px;

      border-radius: 5px;
      background: linear-gradient(135deg, #ffe8f3, #e3f6ff, #e8ffe8);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin: auto;
     

    }

    .card-listingpage p {
      margin: 0;
      font-size: 16px;
      color: #333;
      font-weight: 500;
    }
        .card {
            background: white;
            padding: 16px;
            border-radius: 9px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .card h2 {
            font-size: 20px;
            font-weight: 600;
            margin-top: 6px;
        }

        .section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08)
        }

        .section h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px
        }

        .input {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px
        }

        .btn {
            background: #2563eb;
            color: white;
            padding: 8px 20px;
            border-radius: 8px
        }

        .course-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden
        }

        .delete-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: red;
            color: white;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 6px;
            opacity: 0
        }

        .group:hover .delete-btn {
            opacity: 1
        }

        .logout-button {
            background-color: rgb(226, 226, 226);
            border: 1px solid gray;
            border-radius: 7px;
            padding: 5px 10px;
            color: rgb(71, 71, 71);
        }

        .swiper-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }
        .logo {

    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0px;
}
.logo p{
  font-size: 11px;
  margin: 0px;
  color:gray !important;
}

.course-card {
  border-radius: 1rem;
  overflow: hidden;
  background: white;
  transition: all 0.3s ease;
}

.course-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.input {
  @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition;
}

.notif-table {
  border-collapse: collapse;
  width: 100%;
}

.notif-row {
  transition: background-color 0.2s;
}

.notif-status {
  padding: 0.35rem 0.8rem;
  border-radius: 9999px;
  font-weight: 500;
}

.notif-table th, .notif-table td {
  padding: 1rem 1.5rem;
}
</style>