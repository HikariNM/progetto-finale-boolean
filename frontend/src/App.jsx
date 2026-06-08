import { useState } from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import './App.css'
import DefaultLayout from './layouts/DefaultLayout'
import HomePage from './pages/HomePage'
import BreedPage from './pages/BreedPage'
import LittersPage from './pages/LittersPage'
import OurDogsPage from './pages/OurDogsPage'
import AdultDetailPage from './pages/AdultDetailPage'
import LitterDetailPage from './pages/LitterDetailPage'
import AvailablePuppies from './pages/AvailablePuppies'

function App() {

  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route element={<DefaultLayout />}>
            <Route path="/" element={<HomePage />} />
            <Route path="/la-razza" element={<BreedPage />} />
            <Route path="/cucciolate/in-programma" element={<LittersPage type='upcoming' />} />
            <Route path="/cucciolate/passate" element={<LittersPage type='past' />} />
            <Route path="/cucciolate/:id" element={<LitterDetailPage />} />
            <Route path="/i-nostri-cani/stalloni" element={<OurDogsPage gender='male' />} />
            <Route path="/i-nostri-cani/fattrici" element={<OurDogsPage gender='female' />} />
            <Route path="/i-nostri-cani/:id" element={<AdultDetailPage />} />
            <Route path="/cuccioli-disponibili" element={<AvailablePuppies />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
