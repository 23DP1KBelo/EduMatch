<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" :temporary="mobile" width="270" class="brand-drawer">
      <div class="pa-5 d-flex align-center brand-lockup">
        <v-avatar color="white" rounded="lg" class="mr-3 brand-avatar">
          <v-icon icon="mdi-school" color="primary" />
        </v-avatar>
        <div>
          <div class="text-h6 font-weight-bold">EduMatch</div>
          <div class="text-caption">A place to become</div>
        </div>
      </div>
      <div class="drawer-caption px-5 pt-5 pb-2">EXPLORE</div>
      <v-list nav density="comfortable">
        <v-list-item
          v-for="item in navItems"
          :key="item.key"
          :active="page === item.key"
          :prepend-icon="item.icon"
          :title="item.label"
          rounded="lg"
          @click="navigate(item.key)"
        />
      </v-list>
      <template #append>
        <div class="pa-4 text-caption text-medium-emphasis">Find your next chapter.</div>
      </template>
    </v-navigation-drawer>

    <v-app-bar elevation="0" border="b" color="white" class="topbar">
      <v-app-bar-nav-icon @click="drawer = !drawer" />
      <v-toolbar-title class="font-weight-bold topbar-title"><span class="topbar-kicker">EDUMATCH</span><span>{{ pageTitle }}</span></v-toolbar-title>
      <v-spacer />
      <v-btn icon="mdi-refresh" variant="text" aria-label="Refresh page" class="refresh-button" @click="refreshPage" />
    </v-app-bar>

    <v-main class="app-background">
      <v-container fluid class="pa-4 pa-md-8 content-width">
        <v-alert v-if="error" type="error" variant="tonal" closable class="mb-5" @click:close="error = ''">
          {{ error }}
        </v-alert>
        <v-alert v-if="notice" type="success" variant="tonal" closable class="mb-5" @click:close="notice = ''">
          {{ notice }}
        </v-alert>

        <!-- HOME -->
        <template v-if="page === 'home'">
          <section class="hero-panel mb-7">
            <div class="hero-copy-block">
              <div class="eyebrow"><span></span> YOUR NEXT CHAPTER STARTS HERE</div>
              <h1>Find a place<br>to <em>become.</em></h1>
              <p class="hero-copy">Explore universities and study programmes that fit your ambition, your budget, and the life you want to build.</p>
              <div class="hero-note"><span>✳</span> A clearer path to your future, one good match at a time.</div>
            </div>
            <div class="hero-art" aria-hidden="true">
              <div class="sun-disc"></div><div class="art-orbit orbit-one"></div><div class="art-orbit orbit-two"></div>
              <div class="art-plant plant-left"><i></i><i></i><i></i><b></b></div>
              <div class="art-plant plant-right"><i></i><i></i><i></i><b></b></div>
              <div class="arch"><div class="arch-window"></div></div>
              <div class="art-step step-back"></div><div class="art-step step-front"></div>
              <div class="person"><div class="person-head"></div><div class="person-hair"></div><div class="person-body"></div><div class="person-arm"></div><div class="person-leg"></div><div class="book"></div></div>
              <span class="spark spark-one">✳</span><span class="spark spark-two">✦</span><span class="floating-label">your future<br>looks good ↗</span>
            </div>
            <div class="hero-search-wrap">
              <div class="hero-search-copy"><span>START WITH A SEARCH</span><small>Find the course that feels like yours.</small></div>
              <v-row class="hero-search-row">
                <v-col cols="12" md="12">
                <v-text-field
                  v-model="homeSearch"
                  placeholder="Try ‘computer science’ or a university"
                  prepend-inner-icon="mdi-magnify"
                  variant="solo"
                  rounded="0"
                  hide-details
                  @keyup.enter="searchFromHome"
                >
                  <template #append-inner>
                    <v-btn color="primary" class="search-button" @click="searchFromHome">Find programmes <v-icon end>mdi-arrow-top-right</v-icon></v-btn>
                  </template>
                </v-text-field>
              </v-col>
            </v-row>
            </div>
            <div class="hero-bottom"><span>MADE FOR YOUR NEXT MOVE</span><span>SCROLL TO EXPLORE <b>↓</b></span></div>
          </section>
          <div class="home-section-heading">
            <div><div class="eyebrow eyebrow-muted"><span></span> THE WORLD IS OPEN</div><h2>Find your <em>fit.</em></h2></div>
            <p>Start with what matters to you. We’ll help you find the rest.</p>
          </div>
          <v-row>
            <v-col v-for="card in homeCards" :key="card.key" cols="12" sm="6" lg="3">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100 clickable-card" @click="navigate(card.key)">
                <v-avatar :color="card.color" variant="tonal" size="50" class="mb-4">
                  <v-icon :icon="card.icon" size="26" />
                </v-avatar>
                <div class="text-h6 font-weight-bold mb-2">{{ card.title }}</div>
                <div class="text-body-2 text-medium-emphasis">{{ card.description }}</div>
                <v-btn class="mt-4" variant="text" color="primary" append-icon="mdi-arrow-right">Explore</v-btn>
              </v-card>
            </v-col>
          </v-row>
          <v-card rounded="xl" border elevation="0" class="pa-5 pa-md-7 mt-7">
            <div class="d-flex align-center mb-4">
              <div>
                <div class="text-h5 font-weight-bold">Browse study programs</div>
                <div class="text-body-2 text-medium-emphasis">Search, filter, and open program details.</div>
              </div>
              <v-spacer />
              <v-btn color="primary" variant="tonal" @click="navigate('programs')">View all</v-btn>
            </div>
            <v-row>
              <v-col v-for="program in featuredPrograms" :key="program.id" cols="12" md="4">
                <v-card variant="outlined" rounded="lg" class="pa-4 h-100">
                  <div class="d-flex align-start">
                    <v-avatar color="primary" variant="tonal" rounded="lg" class="mr-3">
                      <v-icon icon="mdi-book-open-variant" />
                    </v-avatar>
                    <div class="flex-grow-1">
                      <div class="font-weight-bold">{{ program.name }}</div>
                      <div class="text-caption text-medium-emphasis">{{ program.university?.name || 'University' }}</div>
                    </div>
                  </div>
                  <div class="d-flex align-center mt-4">
                    <span class="text-body-2">{{ money(program.tuition_fees) }}</span>
                    <v-spacer />
                    <v-btn icon="mdi-arrow-up-right" size="small" variant="text" @click="openProgram(program.id)" />
                  </div>
                </v-card>
              </v-col>
            </v-row>
            <v-skeleton-loader v-if="loading && !featuredPrograms.length" type="list-item-three-line" />
          </v-card>
        </template>

        <!-- UNIVERSITIES -->
        <template v-else-if="page === 'universities'">
          <div class="page-intro">
            <h1 class="text-h4 font-weight-bold">Explore universities</h1>
            <p class="text-body-1 text-medium-emphasis mt-2">Find institutions by name and location.</p>
          </div>
          <v-card rounded="xl" border elevation="0" class="pa-4 mb-5">
            <v-row dense align="center">
              <v-col cols="12" md="5">
                <v-text-field v-model="universityFilters.search" label="Search universities" prepend-inner-icon="mdi-magnify" clearable hide-details variant="outlined" @keyup.enter="loadUniversities(true)" />
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-select v-model="universityFilters.country_id" :items="countries" item-title="name" item-value="id" label="Country" clearable hide-details variant="outlined" />
              </v-col>
              <v-col cols="12" sm="6" md="2">
                <v-select v-model="universityFilters.city_id" :items="cities" item-title="name" item-value="id" label="City" clearable hide-details variant="outlined" :disabled="!universityFilters.country_id" />
              </v-col>
              <v-col cols="12" md="2">
                <v-btn color="primary" block height="48" :loading="loading" @click="loadUniversities(true)">Apply</v-btn>
              </v-col>
            </v-row>
          </v-card>
          <div class="d-flex align-center mb-4">
            <span class="text-body-2 text-medium-emphasis">{{ universityTotal }} universities</span>
            <v-spacer />
            <v-btn variant="text" @click="resetUniversityFilters">Reset filters</v-btn>
          </div>
          <v-row v-if="universitiesPage.length">
            <v-col v-for="university in universitiesPage" :key="university.id" cols="12" sm="6" lg="4">
              <v-card rounded="xl" border elevation="0" class="h-100">
                <div class="university-banner">
                  <v-avatar size="58" color="white" class="elevation-1">
                    <v-icon icon="mdi-bank" color="primary" size="30" />
                  </v-avatar>
                </div>
                <v-card-text class="pa-5">
                  <h2 class="text-h6 font-weight-bold">{{ university.name }}</h2>
                  <div class="text-body-2 text-medium-emphasis mt-2">
                    <v-icon icon="mdi-map-marker-outline" size="small" />
                    {{ locationOf(university) }}
                  </div>
                  <div class="d-flex align-center mt-4">
                    <v-chip size="small" color="primary" variant="tonal">{{ university.study_programs_count ?? 0 }} programs</v-chip>
                    <v-spacer />
                    <v-btn color="primary" variant="text" append-icon="mdi-arrow-right" @click="openUniversity(university.id)">View university</v-btn>
                  </div>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
          <v-empty-state v-else-if="!loading" icon="mdi-bank-outline" title="No universities found" text="Try changing your search or filters." />
          <div v-if="universityLastPage > 1" class="d-flex justify-center mt-6">
            <v-pagination v-model="universityPage" :length="universityLastPage" :total-visible="5" rounded="lg" />
          </div>
        </template>

        <!-- UNIVERSITY DETAIL -->
        <template v-else-if="page === 'university-detail'">
          <v-btn prepend-icon="mdi-arrow-left" variant="text" class="mb-4" @click="navigate('universities')">All universities</v-btn>
          <v-skeleton-loader v-if="loading && !selectedUniversity" type="article, list-item-three-line" />
          <template v-if="selectedUniversity">
            <v-card rounded="xl" border elevation="0" class="pa-6 pa-md-9 mb-6">
              <v-avatar color="primary" variant="tonal" size="72" rounded="xl" class="mb-5"><v-icon icon="mdi-bank" size="38" /></v-avatar>
              <h1 class="text-h4 font-weight-bold">{{ selectedUniversity.name }}</h1>
              <p class="text-body-1 text-medium-emphasis mt-2">{{ locationOf(selectedUniversity) }}</p>
              <v-chip v-if="selectedUniversity.study_programs_count != null" color="primary" variant="tonal" class="mt-4">{{ selectedUniversity.study_programs_count }} study programs</v-chip>
              <div class="mt-5">
                <v-btn v-if="selectedUniversity.website" :href="selectedUniversity.website" target="_blank" rel="noopener" color="primary" prepend-icon="mdi-open-in-new">Visit website</v-btn>
                <v-btn color="primary" variant="tonal" class="ml-2" @click="loadUniversityPrograms(selectedUniversity.id)">Browse programs</v-btn>
              </div>
            </v-card>
            <div class="d-flex align-center mb-4">
              <h2 class="text-h5 font-weight-bold">Programs at this university</h2>
              <v-spacer />
              <v-btn variant="text" @click="loadUniversityPrograms(selectedUniversity.id)">Refresh</v-btn>
            </div>
            <v-row>
              <v-col v-for="program in universityPrograms" :key="program.id" cols="12" md="6" lg="4">
                <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                  <div class="text-h6 font-weight-bold">{{ program.name }}</div>
                  <div class="text-body-2 text-medium-emphasis mt-2">{{ program.degree_level || 'Degree not specified' }} · {{ program.language || 'Language not specified' }}</div>
                  <div class="d-flex align-center mt-5">
                    <span class="font-weight-bold">{{ money(program.tuition_fees) }}</span>
                    <v-spacer />
                    <v-btn icon="mdi-arrow-right" variant="tonal" color="primary" @click="openProgram(program.id)" />
                  </div>
                </v-card>
              </v-col>
            </v-row>
            <v-empty-state v-if="!universityPrograms.length && !loading" icon="mdi-book-open-page-variant" title="No programs listed" text="There are no programs available for this university yet." />
            <div v-if="universityProgramsLastPage > 1" class="d-flex justify-center mt-5">
              <v-pagination v-model="universityProgramsPage" :length="universityProgramsLastPage" :total-visible="5" />
            </div>
          </template>
        </template>

        <!-- PROGRAM CATALOG -->
        <template v-else-if="page === 'programs'">
          <div class="page-intro">
            <h1 class="text-h4 font-weight-bold">Study program finder</h1>
            <p class="text-body-1 text-medium-emphasis mt-2">Use filters to discover programs that match your goals.</p>
          </div>
          <v-row>
            <v-col cols="12" lg="3">
              <v-card rounded="xl" border elevation="0" class="pa-4">
                <div class="d-flex align-center mb-4">
                  <h2 class="text-h6 font-weight-bold">Filters</h2><v-spacer />
                  <v-btn size="small" variant="text" @click="resetProgramFilters">Reset</v-btn>
                </div>
                <v-text-field v-model="programFilters.search" label="Search programs" prepend-inner-icon="mdi-magnify" clearable variant="outlined" density="comfortable" />
                <v-select v-model="programFilters.country_id" :items="countries" item-title="name" item-value="id" label="Country" clearable variant="outlined" density="comfortable" />
                <v-select v-model="programFilters.city_id" :items="cities" item-title="name" item-value="id" label="City" clearable :disabled="!programFilters.country_id" variant="outlined" density="comfortable" />
                <v-select v-model="programFilters.university_id" :items="allUniversities" item-title="name" item-value="id" label="University" clearable variant="outlined" density="comfortable" />
                <v-select v-model="programFilters.degree_level" :items="degrees" label="Degree level" clearable variant="outlined" density="comfortable" />
                <v-select v-model="programFilters.language" :items="languages" label="Language" clearable variant="outlined" density="comfortable" />
                <v-divider class="my-2" />
                <div class="text-subtitle-2 font-weight-bold mb-2">Exclude options</div>
                <v-select v-model="programFilters.exclude_country_ids" :items="countries" item-title="name" item-value="id" label="Exclude countries" hint="Hide programs in these countries" persistent-hint multiple chips closable-chips clearable variant="outlined" density="comfortable" />
                <v-select v-model="programFilters.exclude_city_ids" :items="allCities" item-title="name" item-value="id" label="Exclude cities" hint="Hide programs in these cities" persistent-hint multiple chips closable-chips clearable variant="outlined" density="comfortable" class="mt-3">
                  <template #item="{ props, item }">
                    <v-list-item v-bind="props" :subtitle="countryName(item.raw.country_id)" />
                  </template>
                  <template #selection="{ item, index }">
                    <v-chip v-if="index < 2" size="small">{{ item.title }}</v-chip>
                    <span v-else-if="index === 2" class="text-caption text-medium-emphasis">+{{ programFilters.exclude_city_ids.length - 2 }} more</span>
                  </template>
                </v-select>
                <v-select v-model="programFilters.exclude_languages" :items="languages" label="Exclude languages" hint="Hide programs taught in these languages" persistent-hint multiple chips closable-chips clearable variant="outlined" density="comfortable" class="mt-3" />
                <v-divider class="my-2" />
                <div class="text-subtitle-2 font-weight-bold mb-2">Study fields</div>
                <v-select v-model="programFilters.include_field_ids" :items="fields" item-title="name" item-value="id" label="Include fields" hint="Match any selected field" persistent-hint multiple chips closable-chips clearable variant="outlined" density="comfortable" />
                <v-select v-model="programFilters.exclude_field_ids" :items="fields" item-title="name" item-value="id" label="Exclude fields" hint="Hide any matching field" persistent-hint multiple chips closable-chips clearable variant="outlined" density="comfortable" class="mt-3" />
                <v-text-field v-model.number="programFilters.max_tuition" label="Maximum tuition" type="number" min="0" clearable variant="outlined" density="comfortable" />
                <v-checkbox v-model="programFilters.scholarships" label="Scholarships available" hide-details density="comfortable" />
                <v-btn color="primary" block size="large" :loading="loading" @click="loadPrograms(true)">Apply filters</v-btn>
              </v-card>
            </v-col>
            <v-col cols="12" lg="9">
              <div class="d-flex align-center mb-4">
                <div><h2 class="text-h5 font-weight-bold">Available programs</h2><div class="text-body-2 text-medium-emphasis">{{ programTotal }} results</div></div>
                <v-spacer />
                <v-btn variant="text" prepend-icon="mdi-refresh" @click="loadPrograms()">Refresh</v-btn>
              </div>
              <v-row v-if="programs.length">
                <v-col v-for="program in programs" :key="program.id" cols="12" md="6" xl="4">
                  <v-card rounded="xl" border elevation="0" class="h-100 program-card">
                    <div class="program-art pa-5 d-flex align-center">
                      <v-icon icon="mdi-book-open-variant" size="38" color="primary" />
                      <v-spacer />
                      <v-chip v-if="program.degree_level" color="primary" variant="tonal" size="small">{{ program.degree_level }}</v-chip>
                    </div>
                    <v-card-text class="pa-5">
                      <div class="text-caption text-primary font-weight-bold">{{ program.university?.name || 'University' }}</div>
                      <h3 class="text-h6 font-weight-bold mt-1">{{ program.name }}</h3>
                      <div class="text-body-2 text-medium-emphasis mt-2"><v-icon icon="mdi-map-marker-outline" size="small" /> {{ locationOf(program.university) }}</div>
                      <div class="d-flex flex-wrap ga-1 mt-3">
                        <v-chip v-if="program.language" size="x-small" variant="outlined">{{ program.language }}</v-chip>
                        <v-chip v-if="program.duration" size="x-small" variant="outlined">{{ program.duration }}</v-chip>
                        <v-chip v-for="field in (program.study_fields || [])" :key="field.id" size="x-small" color="secondary" variant="tonal">{{ field.name }}</v-chip>
                      </div>
                      <v-divider class="my-4" />
                      <div class="d-flex align-center">
                        <div><div class="text-caption text-medium-emphasis">Tuition</div><div class="font-weight-bold">{{ money(program.tuition_fees) }}</div></div>
                        <v-spacer />
                        <v-btn icon="mdi-arrow-right" variant="tonal" color="primary" :aria-label="'View ' + program.name" @click="openProgram(program.id)" />
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-skeleton-loader v-if="loading && !programs.length" type="card, card, card" />
              <v-empty-state v-else-if="!programs.length && !loading" icon="mdi-magnify" title="No programs found" text="Try removing filters or using a different search." />
              <div v-if="programLastPage > 1" class="d-flex justify-center mt-6"><v-pagination v-model="programPage" :length="programLastPage" :total-visible="5" rounded="lg" /></div>
            </v-col>
          </v-row>
        </template>

        <!-- PROGRAM DETAIL -->
        <template v-else-if="page === 'program-detail'">
          <v-btn prepend-icon="mdi-arrow-left" variant="text" class="mb-4" @click="navigate('programs')">Back to programs</v-btn>
          <v-skeleton-loader v-if="loading && !selectedProgram" type="article, article" />
          <template v-if="selectedProgram">
            <v-card rounded="xl" border elevation="0" class="overflow-hidden">
              <div class="detail-banner pa-6 pa-md-10">
                <v-chip color="white" variant="outlined" class="mb-4">{{ selectedProgram.degree_level || 'Study program' }}</v-chip>
                <h1 class="text-h4 text-md-h3 font-weight-bold">{{ selectedProgram.name }}</h1>
                <div class="text-body-1 mt-3">{{ selectedProgram.university?.name || 'University' }}</div>
                <div class="mt-2"><v-icon icon="mdi-map-marker-outline" size="small" /> {{ locationOf(selectedProgram.university) }}</div>
              </div>
              <v-card-text class="pa-5 pa-md-8">
                <v-row>
                  <v-col cols="12" sm="6" md="3"><div class="metric-label">Tuition fees</div><div class="text-h6 font-weight-bold">{{ money(selectedProgram.tuition_fees) }}</div></v-col>
                  <v-col cols="12" sm="6" md="3"><div class="metric-label">Duration</div><div class="text-h6 font-weight-bold">{{ selectedProgram.duration || 'Not specified' }}</div></v-col>
                  <v-col cols="12" sm="6" md="3"><div class="metric-label">Language</div><div class="text-h6 font-weight-bold">{{ selectedProgram.language || 'Not specified' }}</div></v-col>
                  <v-col cols="12" sm="6" md="3"><div class="metric-label">Application deadline</div><div class="text-h6 font-weight-bold">{{ selectedProgram.application_deadline || 'Not specified' }}</div></v-col>
                </v-row>
                <v-divider class="my-6" />
                <v-row>
                  <v-col cols="12" md="7">
                    <h2 class="text-h6 font-weight-bold mb-3">About this program</h2>
                    <p class="text-body-1 text-medium-emphasis">{{ selectedProgram.admission_requirements || 'Admission requirements have not been provided.' }}</p>
                    <h2 class="text-h6 font-weight-bold mt-7 mb-3">Study fields</h2>
                    <div v-if="selectedProgram.study_fields?.length" class="d-flex flex-wrap ga-2">
                      <v-chip v-for="field in selectedProgram.study_fields" :key="field.id" color="primary" variant="tonal">{{ field.name }}</v-chip>
                    </div>
                    <p v-else class="text-body-2 text-medium-emphasis">No study fields listed.</p>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-card color="surface-variant" variant="tonal" rounded="xl" class="pa-5">
                      <h2 class="text-h6 font-weight-bold mb-3">Scholarships</h2>
                      <template v-if="selectedProgram.scholarships?.length">
                        <div v-for="scholarship in selectedProgram.scholarships" :key="scholarship.id" class="mb-4">
                          <div class="font-weight-bold">{{ scholarship.name }}</div>
                          <div class="text-body-2">{{ scholarship.description || 'No description provided.' }}</div>
                          <div class="text-body-2 mt-1">{{ money(scholarship.amount, scholarship.currency) }}</div>
                          <div v-if="scholarship.deadline" class="text-caption mt-1">Deadline: {{ scholarship.deadline }}</div>
                        </div>
                      </template>
                      <p v-else class="text-body-2">No scholarships are currently listed for this program.</p>
                      <v-btn v-if="selectedProgram.university?.website" :href="selectedProgram.university.website" target="_blank" rel="noopener" block color="primary" class="mt-4" append-icon="mdi-open-in-new">University website</v-btn>
                    </v-card>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </template>
        </template>

        <!-- STUDY FIELDS -->
        <template v-else-if="page === 'fields'">
          <div class="page-intro"><h1 class="text-h4 font-weight-bold">Study fields</h1><p class="text-body-1 text-medium-emphasis mt-2">Browse available areas of study.</p></div>
          <v-text-field v-model="fieldSearch" label="Search study fields" prepend-inner-icon="mdi-magnify" clearable variant="outlined" class="max-search" />
          <v-row>
            <v-col v-for="field in filteredFields" :key="field.id" cols="12" sm="6" md="4" lg="3">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <v-avatar color="primary" variant="tonal" rounded="lg" class="mb-4"><v-icon icon="mdi-shape-outline" /></v-avatar>
                <h2 class="text-h6 font-weight-bold">{{ field.name }}</h2>
                <p class="text-body-2 text-medium-emphasis mt-2">{{ field.description || 'Explore programs related to this study field.' }}</p>
                <v-btn color="primary" variant="text" class="mt-3" append-icon="mdi-arrow-right" @click="programsForField(field)">Find programs</v-btn>
              </v-card>
            </v-col>
          </v-row>
          <v-empty-state v-if="!filteredFields.length" icon="mdi-shape-outline" title="No study fields found" />
        </template>

        <!-- COUNTRIES -->
        <template v-else-if="page === 'countries'">
          <div class="page-intro"><h1 class="text-h4 font-weight-bold">Countries</h1><p class="text-body-1 text-medium-emphasis mt-2">Explore destination countries available in EduMatch.</p></div>
          <v-text-field v-model="countrySearch" label="Search countries" prepend-inner-icon="mdi-magnify" clearable variant="outlined" class="max-search" />
          <v-row>
            <v-col v-for="country in filteredCountries" :key="country.id" cols="12" sm="6" md="4" lg="3">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <v-avatar color="primary" variant="tonal" rounded="lg" class="mb-4"><v-icon icon="mdi-earth" /></v-avatar>
                <h2 class="text-h6 font-weight-bold">{{ country.name }}</h2>
                <div class="text-body-2 text-medium-emphasis mt-2">Code: {{ country.country_code || 'Not provided' }}</div>
                <div class="text-body-2 text-medium-emphasis">Currency: {{ country.currency || 'Not provided' }}</div>
                <v-btn color="primary" variant="text" class="mt-3" append-icon="mdi-arrow-right" @click="browseCountry(country)">Browse programs</v-btn>
              </v-card>
            </v-col>
          </v-row>
          <v-empty-state v-if="!filteredCountries.length" icon="mdi-earth" title="No countries found" />
        </template>

        <!-- CITIES -->
        <template v-else-if="page === 'cities'">
          <div class="page-intro"><h1 class="text-h4 font-weight-bold">Cities</h1><p class="text-body-1 text-medium-emphasis mt-2">Browse cities and their estimated living costs where available.</p></div>
          <v-card rounded="xl" border elevation="0" class="pa-4 mb-5">
            <v-row dense align="center">
              <v-col cols="12" md="5"><v-text-field v-model="citySearch" label="Search cities" prepend-inner-icon="mdi-magnify" clearable hide-details variant="outlined" /></v-col>
              <v-col cols="12" md="5"><v-select v-model="cityCountryId" :items="countries" item-title="name" item-value="id" label="Country" clearable hide-details variant="outlined" /></v-col>
              <v-col cols="12" md="2"><v-btn block color="primary" height="48" @click="loadCities">Apply</v-btn></v-col>
            </v-row>
          </v-card>
          <v-row>
            <v-col v-for="city in filteredCities" :key="city.id" cols="12" sm="6" md="4">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <v-avatar color="primary" variant="tonal" rounded="lg" class="mb-4"><v-icon icon="mdi-city-variant-outline" /></v-avatar>
                <h2 class="text-h6 font-weight-bold">{{ city.name }}</h2>
                <div class="text-body-2 text-medium-emphasis mt-2">{{ countryName(city.country_id) }}</div>
                <div class="mt-4">
                  <div class="text-caption text-medium-emphasis">Average living cost</div>
                  <div class="font-weight-bold">{{ money(city.average_living_cost) }}</div>
                </div>
                <v-btn color="primary" variant="text" class="mt-3" @click="browseCity(city)">Find programs here</v-btn>
              </v-card>
            </v-col>
          </v-row>
          <v-empty-state v-if="!filteredCities.length && !loading" icon="mdi-city-variant-outline" title="No cities found" text="Try another country or search." />
        </template>

        <!-- FILTER OPTIONS -->
        <template v-else-if="page === 'filters'">
          <div class="page-intro"><h1 class="text-h4 font-weight-bold">Filter directory</h1><p class="text-body-1 text-medium-emphasis mt-2">Available values returned by the study-filters endpoint.</p></div>
          <v-row>
            <v-col cols="12" md="6">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <div class="d-flex align-center mb-4"><v-icon icon="mdi-earth" color="primary" class="mr-2" /><h2 class="text-h6 font-weight-bold">Countries</h2><v-spacer /><v-chip>{{ filterData.countries?.length || 0 }}</v-chip></div>
                <v-chip v-for="country in (filterData.countries || [])" :key="country.id" class="ma-1" variant="tonal">{{ country.name }}</v-chip>
              </v-card>
            </v-col>
            <v-col cols="12" md="6">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <div class="d-flex align-center mb-4"><v-icon icon="mdi-shape-outline" color="primary" class="mr-2" /><h2 class="text-h6 font-weight-bold">Study fields</h2><v-spacer /><v-chip>{{ filterData.fields?.length || 0 }}</v-chip></div>
                <v-chip v-for="field in (filterData.fields || [])" :key="field.id" class="ma-1" variant="tonal">{{ field.name }}</v-chip>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <div class="text-subtitle-1 font-weight-bold mb-3">Degree levels</div>
                <v-list density="compact"><v-list-item v-for="degree in (filterData.degrees || [])" :key="degree" :title="degree" /></v-list>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <div class="text-subtitle-1 font-weight-bold mb-3">Languages</div>
                <v-list density="compact"><v-list-item v-for="language in (filterData.languages || [])" :key="language" :title="language" /></v-list>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card rounded="xl" border elevation="0" class="pa-5 h-100">
                <div class="text-subtitle-1 font-weight-bold mb-3">Maximum tuition in database</div>
                <div class="text-h4 font-weight-bold">{{ money(filterData.max_tuition) }}</div>
                <p class="text-body-2 text-medium-emphasis mt-2">This is the maximum stored fee, not a standardized currency conversion.</p>
              </v-card>
            </v-col>
          </v-row>
          <v-btn color="primary" class="mt-5" @click="navigate('programs')">Use these filters</v-btn>
        </template>
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import { computed, onMounted, reactive, ref, watch } from 'vue';
import { useDisplay } from 'vuetify';

const { mobile } = useDisplay();
const drawer = ref(false);
const page = ref('home');
const loading = ref(false);
const error = ref('');
const notice = ref('');
const homeSearch = ref('');

const navItems = [
  { key: 'home', label: 'Overview', icon: 'mdi-view-dashboard-outline' },
  { key: 'universities', label: 'Universities', icon: 'mdi-bank-outline' },
  { key: 'programs', label: 'Study programs', icon: 'mdi-book-open-variant' },
  { key: 'fields', label: 'Study fields', icon: 'mdi-shape-outline' },
  { key: 'countries', label: 'Countries', icon: 'mdi-earth' },
  { key: 'cities', label: 'Cities', icon: 'mdi-city-variant-outline' },
  { key: 'filters', label: 'Filter directory', icon: 'mdi-tune-variant' },
];
const homeCards = [
  { key: 'universities', title: 'Universities', description: 'Explore institutions and see their available programs.', icon: 'mdi-bank-outline', color: 'blue' },
  { key: 'programs', title: 'Study programs', description: 'Search courses by location, language, fees, and field.', icon: 'mdi-book-open-variant', color: 'indigo' },
  { key: 'fields', title: 'Study fields', description: 'Discover areas of study and find related programs.', icon: 'mdi-shape-outline', color: 'teal' },
  { key: 'countries', title: 'Destinations', description: 'Browse countries and cities for your study journey.', icon: 'mdi-earth', color: 'deep-purple' },
];

const countries = ref([]);
const cities = ref([]);
const allCities = ref([]);
const universities = ref([]);
const allUniversities = ref([]);
const fields = ref([]);
const degrees = ref([]);
const languages = ref([]);
const filterData = ref({ countries: [], fields: [], degrees: [], languages: [], max_tuition: null });
const featuredPrograms = ref([]);
const programs = ref([]);
const programPage = ref(1);
const programLastPage = ref(1);
const programTotal = ref(0);
const universityPage = ref(1);
const universityLastPage = ref(1);
const universityTotal = ref(0);
const universitiesPage = ref([]);
const selectedUniversity = ref(null);
const universityPrograms = ref([]);
const universityProgramsPage = ref(1);
const universityProgramsLastPage = ref(1);
const selectedProgram = ref(null);

const universityFilters = reactive({ search: '', country_id: null, city_id: null });
const programFilters = reactive({
  search: '', country_id: null, city_id: null, university_id: null,
  degree_level: null, language: null, include_field_ids: [], exclude_field_ids: [],
  exclude_country_ids: [], exclude_city_ids: [], exclude_languages: [],
  max_tuition: null, scholarships: false,
});
const fieldSearch = ref('');
const countrySearch = ref('');
const citySearch = ref('');
const cityCountryId = ref(null);

const pageTitle = computed(() => ({
  home: 'Overview',
  universities: 'Universities',
  'university-detail': selectedUniversity.value?.name || 'University details',
  programs: 'Study programs',
  'program-detail': selectedProgram.value?.name || 'Program details',
  fields: 'Study fields',
  countries: 'Countries',
  cities: 'Cities',
  filters: 'Filter directory',
}[page.value] || 'EduMatch'));

const filteredFields = computed(() => fields.value.filter(f => f.name.toLowerCase().includes(fieldSearch.value.toLowerCase())));
const filteredCountries = computed(() => countries.value.filter(c => c.name.toLowerCase().includes(countrySearch.value.toLowerCase())));
const filteredCities = computed(() => {
  const q = citySearch.value.toLowerCase();
  return cities.value.filter(c => c.name.toLowerCase().includes(q));
});

async function getJson(url) {
  const response = await fetch(url, { headers: { Accept: 'application/json' } });
  if (!response.ok) {
    let message = `Request failed (${response.status})`;
    try {
      const body = await response.json();
      message = body.message || message;
    } catch {}
    throw new Error(message);
  }
  return response.json();
}

function setError(e) {
  error.value = e?.message || 'Something went wrong while loading data.';
}

async function loadSharedOptions() {
  const [filterResult, cityResult, universityResult, fieldResult] = await Promise.all([
    getJson('/api/study-filters'),
    getJson('/api/cities'),
    getJson('/api/universities'),
    getJson('/api/study-fields'),
  ]);
  filterData.value = filterResult;
  countries.value = filterResult.countries || [];
  fields.value = fieldResult || filterResult.fields || [];
  degrees.value = filterResult.degrees || [];
  languages.value = filterResult.languages || [];
  allCities.value = cityResult || [];
  cities.value = cityResult || [];
  allUniversities.value = universityResult.data || [];
  universities.value = universityResult.data || [];
}

function navigate(next) {
  page.value = next;
  drawer.value = false;
  error.value = '';
  if (next === 'universities' && !universitiesPage.value.length) loadUniversities(true);
  if (next === 'programs' && !programs.value.length) loadPrograms(true);
  if (next === 'fields' && !fields.value.length) loadFields();
  if (next === 'countries' && !countries.value.length) loadCountries();
  if (next === 'cities') loadCities();
  if (next === 'filters') loadFilterData();
}

function refreshPage() {
  if (page.value === 'universities') return loadUniversities();
  if (page.value === 'university-detail' && selectedUniversity.value) return loadUniversityPrograms(selectedUniversity.value.id);
  if (page.value === 'programs') return loadPrograms();
  if (page.value === 'program-detail' && selectedProgram.value) return openProgram(selectedProgram.value.id);
  if (page.value === 'fields') return loadFields();
  if (page.value === 'countries') return loadCountries();
  if (page.value === 'cities') return loadCities();
  if (page.value === 'filters') return loadFilterData();
  return loadHome();
}

async function loadHome() {
  loading.value = true; error.value = '';
  try {
    const result = await getJson('/api/study-programs');
    featuredPrograms.value = (result.data || []).slice(0, 3);
  } catch (e) { setError(e); }
  finally { loading.value = false; }
}

async function loadUniversities(resetPage = false) {
  if (resetPage) universityPage.value = 1;
  loading.value = true; error.value = '';
  try {
    const params = new URLSearchParams({ page: String(universityPage.value) });
    if (universityFilters.search?.trim()) params.set('search', universityFilters.search.trim());
    if (universityFilters.country_id) params.set('country_id', String(universityFilters.country_id));
    if (universityFilters.city_id) params.set('city_id', String(universityFilters.city_id));
    const result = await getJson(`/api/universities?${params}`);
    universitiesPage.value = result.data || [];
    universityPage.value = result.current_page || 1;
    universityLastPage.value = result.last_page || 1;
    universityTotal.value = result.total || 0;
  } catch (e) { setError(e); }
  finally { loading.value = false; }
}

function resetUniversityFilters() {
  Object.assign(universityFilters, { search: '', country_id: null, city_id: null });
  universityPage.value = 1;
  loadUniversities(true);
}

async function openUniversity(id) {
  loading.value = true; error.value = '';
  selectedUniversity.value = null;
  universityPrograms.value = [];
  page.value = 'university-detail';
  try {
    selectedUniversity.value = await getJson(`/api/universities/${id}`);
    await loadUniversityPrograms(id);
  } catch (e) { setError(e); }
  finally { loading.value = false; }
}

async function loadUniversityPrograms(id) {
  loading.value = true; error.value = '';
  try {
    const params = new URLSearchParams({ page: String(universityProgramsPage.value) });
    const result = await getJson(`/api/universities/${id}/programs?${params}`);
    universityPrograms.value = result.data || [];
    universityProgramsPage.value = result.current_page || 1;
    universityProgramsLastPage.value = result.last_page || 1;
  } catch (e) { setError(e); }
  finally { loading.value = false; }
}

async function loadPrograms(resetPage = false) {
  if (resetPage) programPage.value = 1;
  loading.value = true; error.value = '';
  try {
    const params = new URLSearchParams({ page: String(programPage.value) });
    const scalarKeys = ['search', 'country_id', 'city_id', 'university_id', 'degree_level', 'language', 'max_tuition'];
    scalarKeys.forEach(key => {
      const value = programFilters[key];
      if (value !== null && value !== undefined && value !== '') params.set(key, String(value).trim());
    });
    programFilters.include_field_ids.forEach(id => params.append('include_field_ids[]', String(id)));
    programFilters.exclude_field_ids.forEach(id => params.append('exclude_field_ids[]', String(id)));
    programFilters.exclude_country_ids.forEach(id => params.append('exclude_country_ids[]', String(id)));
    programFilters.exclude_city_ids.forEach(id => params.append('exclude_city_ids[]', String(id)));
    programFilters.exclude_languages.forEach(language => params.append('exclude_languages[]', language));
    if (programFilters.scholarships) params.set('scholarships', '1');
    const result = await getJson(`/api/study-programs?${params}`);
    programs.value = result.data || [];
    programPage.value = result.current_page || 1;
    programLastPage.value = result.last_page || 1;
    programTotal.value = result.total || 0;
  } catch (e) { setError(e); }
  finally { loading.value = false; }
}

function resetProgramFilters() {
  Object.assign(programFilters, {
    search: '', country_id: null, city_id: null, university_id: null,
    degree_level: null, language: null, include_field_ids: [], exclude_field_ids: [],
    exclude_country_ids: [], exclude_city_ids: [], exclude_languages: [],
    max_tuition: null, scholarships: false,
  });
  programPage.value = 1;
  loadPrograms(true);
}

async function openProgram(id) {
  loading.value = true; error.value = '';
  selectedProgram.value = null;
  page.value = 'program-detail';
  try { selectedProgram.value = await getJson(`/api/study-programs/${id}`); }
  catch (e) { setError(e); }
  finally { loading.value = false; }
}

async function loadFields() {
  loading.value = true; error.value = '';
  try { fields.value = await getJson('/api/study-fields'); }
  catch (e) { setError(e); }
  finally { loading.value = false; }
}

async function loadCountries() {
  loading.value = true; error.value = '';
  try { countries.value = await getJson('/api/countries'); }
  catch (e) { setError(e); }
  finally { loading.value = false; }
}

async function loadCities() {
  loading.value = true; error.value = '';
  try {
    const params = new URLSearchParams();
    if (cityCountryId.value) params.set('country_id', String(cityCountryId.value));
    const url = `/api/cities${params.size ? `?${params}` : ''}`;
    cities.value = await getJson(url);
    if (!cityCountryId.value) allCities.value = cities.value;
  } catch (e) { setError(e); }
  finally { loading.value = false; }
}

async function loadFilterData() {
  loading.value = true; error.value = '';
  try {
    filterData.value = await getJson('/api/study-filters');
    countries.value = filterData.value.countries || [];
    fields.value = filterData.value.fields || [];
    degrees.value = filterData.value.degrees || [];
    languages.value = filterData.value.languages || [];
  } catch (e) { setError(e); }
  finally { loading.value = false; }
}

function searchFromHome() {
  programFilters.search = homeSearch.value;
  page.value = 'programs';
  loadPrograms(true);
}

function programsForField(field) {
  programFilters.include_field_ids = [field.id];
  page.value = 'programs';
  loadPrograms(true);
}

function browseCountry(country) {
  programFilters.country_id = country.id;
  programFilters.city_id = null;
  page.value = 'programs';
  loadPrograms(true);
}

function browseCity(city) {
  programFilters.country_id = city.country_id;
  programFilters.city_id = city.id;
  page.value = 'programs';
  loadPrograms(true);
}

function locationOf(entity) {
  if (!entity) return 'Location not specified';
  const city = entity.city?.name;
  const country = entity.city?.country?.name;
  return [city, country].filter(Boolean).join(', ') || 'Location not specified';
}

function countryName(id) {
  return countries.value.find(country => country.id === id)?.name || 'Country not specified';
}

function money(value, currency = '') {
  if (value === null || value === undefined || value === '') return 'Not specified';
  const formatted = new Intl.NumberFormat(undefined, { maximumFractionDigits: 2 }).format(Number(value));
  return currency ? `${currency} ${formatted}` : formatted;
}

watch(universityPage, (next, old) => { if (next !== old && page.value === 'universities') loadUniversities(); });
watch(programPage, (next, old) => { if (next !== old && page.value === 'programs') loadPrograms(); });
watch(universityProgramsPage, (next, old) => {
  if (next !== old && page.value === 'university-detail' && selectedUniversity.value) loadUniversityPrograms(selectedUniversity.value.id);
});
watch(() => universityFilters.country_id, async (countryId) => {
  universityFilters.city_id = null;
  if (!countryId) { cities.value = allCities.value; return; }
  try {
    const params = new URLSearchParams({ country_id: String(countryId) });
    cities.value = await getJson(`/api/cities?${params}`);
  } catch (e) { setError(e); }
});
watch(() => programFilters.country_id, async (countryId) => {
  programFilters.city_id = null;
  if (!countryId) { cities.value = allCities.value; return; }
  try {
    const params = new URLSearchParams({ country_id: String(countryId) });
    cities.value = await getJson(`/api/cities?${params}`);
  } catch (e) { setError(e); }
});

onMounted(async () => {
  loading.value = true;
  try {
    await loadSharedOptions();
    await loadHome();
    // Load the full city list again after any country-specific watcher has settled.
    cities.value = allCities.value;
  } catch (e) { setError(e); }
  finally { loading.value = false; }
});
</script>

<style>
:root {
  color-scheme: light;
  --em-forest: #214d3b;
  --em-forest-dark: #183c2e;
  --em-sage: #e9eee5;
  --em-paper: #fbfaf7;
  --em-ink: #253a30;
  --em-muted: #758278;
  --em-line: #e7e7de;
  --em-clay: #cc7957;
}

body { margin: 0; background: var(--em-paper); }
.v-application { color: var(--em-ink); font-family: 'DM Sans', sans-serif; background: var(--em-paper); }
.v-application__wrap { min-height: 100vh; }
.app-background { background: var(--em-paper); min-height: 100vh; }
.content-width { max-width: 1510px; margin: 0 auto; }
.v-main .v-container { padding-top: 32px !important; padding-bottom: 72px !important; }

/* Navigation */
.brand-drawer { background: var(--em-forest-dark) !important; color: #f8f6ef !important; border: 0 !important; }
.brand-lockup { min-height: 91px; color: #fbfaf7; }
.brand-lockup .text-caption { color: #bbcec0; letter-spacing: .04em; }
.brand-avatar { border-radius: 10px !important; }
.drawer-caption { color: #9bb1a2; font-size: 9px; font-weight: 700; letter-spacing: 1.7px; }
.brand-drawer .v-list { padding: 7px 11px; }
.brand-drawer .v-list-item { min-height: 46px; margin: 3px 0; color: #d0dbd1; border-radius: 7px !important; font-size: 13px; }
.brand-drawer .v-list-item--active { color: #fff !important; background: #315d48; }
.brand-drawer .v-list-item--active .v-icon { color: #efaa83; }
.brand-drawer .v-list-item__overlay { display: none; }
.brand-drawer .v-list-item__prepend > .v-icon { opacity: .9; }
.topbar { background: var(--em-paper) !important; border-color: var(--em-line) !important; }
.topbar-title { display: flex; flex-direction: column; justify-content: center; color: var(--em-ink); line-height: 1.1; font-family: Manrope, sans-serif; font-size: 17px !important; }
.topbar-kicker { color: #9a7966; font: 700 8px/1.5 'DM Sans', sans-serif; letter-spacing: 1.6px; }
.topbar .v-app-bar-nav-icon, .refresh-button { color: var(--em-forest) !important; }
.v-app-bar { box-shadow: none !important; }

/* Shared surfaces and controls */
.v-theme--eduMatchLight { color-scheme: light; --v-theme-primary: 33, 77, 59; --v-theme-secondary: 204, 121, 87; --v-theme-background: 251, 250, 247; --v-theme-surface: 255, 255, 255; --v-theme-surface-variant: 238, 241, 232; }
.v-theme--eduMatchLight .v-card, .v-theme--eduMatchLight .v-field, .v-theme--eduMatchLight .v-input__control { color-scheme: light; }
.v-card { border-color: var(--em-line) !important; box-shadow: 0 4px 18px rgba(36, 55, 43, .035) !important; }
.v-card-title, .v-card-text, .v-card-actions { color: var(--em-ink); }
.v-btn { letter-spacing: .01em; text-transform: none; font-weight: 600; }
.v-btn--variant-flat.bg-primary, .v-btn--variant-elevated.bg-primary { background: var(--em-forest) !important; }
.v-btn--variant-tonal.bg-primary { color: var(--em-forest) !important; background: #e8eee7 !important; }
.v-chip { font-weight: 600; }
.v-field { border-radius: 6px !important; }
.v-field--variant-outlined .v-field__outline { color: #dfe2d9; }
.v-field--focused .v-field__outline { color: var(--em-forest) !important; }
.v-label, .v-field__input, .v-select__selection-text { font-family: 'DM Sans', sans-serif; }
.v-alert { border-radius: 8px !important; }
.page-intro { margin: 6px 0 28px; }
.page-intro h1 { color: var(--em-forest-dark); font: 700 clamp(30px, 4vw, 43px)/1.12 Manrope, sans-serif; letter-spacing: -1.8px; }
.page-intro p { color: var(--em-muted) !important; font-size: 14px; }
.max-search { max-width: 560px; }
.v-empty-state { border: 1px dashed #dfe4da; border-radius: 10px; background: #fffefa; }

/* Landing page */
.hero-panel {
  min-height: 535px;
  position: relative;
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  overflow: hidden;
  padding: 54px 6% 141px;
  color: var(--em-ink);
  border-radius: 4px;
  background: #eef1e8;
}
.hero-copy-block { position: relative; z-index: 1; padding: 5px 0 14px; }
.eyebrow { display: flex; align-items: center; gap: 9px; color: #64796b; font-size: 9px; font-weight: 700; letter-spacing: 1.65px; }
.eyebrow > span { width: 7px; height: 7px; display: inline-block; border-radius: 50%; background: var(--em-clay); }
.hero-panel h1 { margin: 23px 0 21px; color: #203b30; font: 500 clamp(52px, 6.7vw, 82px)/.99 Manrope, sans-serif; letter-spacing: -4.6px; }
.hero-panel h1 em, .home-section-heading h2 em { color: var(--em-clay); font: 400 1em/1 Georgia, serif; }
.hero-copy { max-width: 430px; margin: 0; color: #64746a; font-size: 14px; line-height: 1.85; }
.hero-note { margin-top: 31px; color: #607267; font: italic 12px Georgia, serif; }
.hero-note span { margin-right: 7px; color: var(--em-clay); font-size: 17px; }
.hero-art { position: relative; justify-self: end; width: min(100%, 510px); height: 340px; margin: -8px 0 0; }
.sun-disc { position: absolute; top: 15px; left: 22%; width: 255px; height: 255px; border-radius: 50%; background: #e7bc8d; }
.art-orbit { position: absolute; border: 1px solid rgba(79, 114, 94, .28); border-radius: 50%; transform: rotate(-27deg); }
.orbit-one { top: 80px; left: 2%; width: 94%; height: 170px; }
.orbit-two { top: 56px; left: 10%; width: 82%; height: 235px; transform: rotate(22deg); }
.arch { position: absolute; bottom: 27px; left: 32%; width: 190px; height: 245px; overflow: hidden; border-radius: 100px 100px 0 0; background: #b77b5f; }
.arch-window { position: absolute; top: 35px; left: 30px; width: 130px; height: 182px; border: 1px solid rgba(255, 231, 209, .55); border-radius: 75px 75px 0 0; }
.arch-window::after { position: absolute; left: 50%; width: 1px; height: 100%; content: ''; background: rgba(255, 231, 209, .48); }
.art-step { position: absolute; bottom: 27px; height: 30px; background: #41664f; }
.step-back { left: 17%; width: 66%; }
.step-front { bottom: 0; left: 11%; width: 78%; background: #557a62; }
.person { position: absolute; bottom: 27px; left: 45%; width: 110px; height: 198px; }
.person-head { position: absolute; z-index: 2; top: 23px; left: 42px; width: 39px; height: 48px; border-radius: 48%; background: #bd7753; }
.person-hair { position: absolute; z-index: 3; top: 18px; left: 39px; width: 45px; height: 31px; border-radius: 50% 55% 30% 35%; background: #3d352e; transform: rotate(-12deg); }
.person-body { position: absolute; top: 70px; left: 25px; width: 78px; height: 92px; border-radius: 34px 34px 8px 8px; background: #eacb9e; transform: rotate(-3deg); }
.person-arm { position: absolute; z-index: 4; top: 80px; left: 5px; width: 74px; height: 18px; border-radius: 20px; background: #bd7753; transform: rotate(-39deg); }
.person-leg { position: absolute; bottom: 0; left: 43px; width: 25px; height: 65px; border-radius: 0 0 10px 10px; background: #415b49; transform: rotate(5deg); }
.book { position: absolute; z-index: 5; top: 47px; left: 0; width: 47px; height: 34px; border: 3px solid #f2dfc4; background: #d07b53; transform: rotate(-20deg); }
.art-plant { position: absolute; z-index: 1; bottom: 27px; width: 75px; height: 108px; }
.plant-left { left: 6%; }
.plant-right { right: 2%; transform: scale(.8); }
.art-plant b { position: absolute; bottom: 0; left: 29px; width: 22px; height: 42px; border-radius: 4px 4px 11px 11px; background: #bb825f; }
.art-plant i { position: absolute; bottom: 34px; width: 23px; height: 42px; border-radius: 100% 0; background: #67856b; transform-origin: bottom; }
.art-plant i:nth-child(1) { left: 12px; transform: rotate(-38deg); }
.art-plant i:nth-child(2) { left: 31px; transform: rotate(16deg) scale(.9); }
.art-plant i:nth-child(3) { bottom: 63px; left: 27px; transform: rotate(-13deg) scale(.8); }
.spark { position: absolute; color: var(--em-clay); }
.spark-one { top: 24px; right: 10%; font-size: 27px; }
.spark-two { top: 84px; left: 7%; font-size: 18px; }
.floating-label { position: absolute; z-index: 2; top: 112px; right: 0; padding: 11px 14px; color: #577060; background: var(--em-paper); box-shadow: 0 8px 24px rgba(51, 72, 50, .08); font: italic 12px/1.4 Georgia, serif; transform: rotate(4deg); }
.hero-search-wrap { position: absolute; z-index: 2; right: 6%; bottom: 49px; left: 6%; display: flex; align-items: center; gap: 26px; }
.hero-search-copy { display: flex; min-width: 188px; flex-direction: column; gap: 5px; }
.hero-search-copy span { color: #5c7564; font-size: 9px; font-weight: 700; letter-spacing: 1.3px; }
.hero-search-copy small { color: #879187; font: italic 11px Georgia, serif; }
.hero-search-row { flex: 1; margin: 0; }
.hero-search-row .v-col { padding: 0; }
.hero-search-row .v-input { background: #fff; box-shadow: 0 8px 25px rgba(38, 60, 45, .08); }
.hero-search-row .v-field { border-radius: 4px !important; }
.hero-search-row .v-field__input { min-height: 56px; }
.hero-search-row .search-button { min-height: 42px; margin-right: 4px; padding: 0 16px; font-size: 11px; }
.hero-bottom { position: absolute; right: 6%; bottom: 0; left: 6%; display: flex; height: 34px; align-items: center; justify-content: space-between; border-top: 1px solid #dfe3d8; color: #879288; font-size: 8px; letter-spacing: 1.4px; }
.hero-bottom b { margin-left: 8px; color: var(--em-clay); font-size: 15px; }
.home-section-heading { display: flex; align-items: end; justify-content: space-between; margin: 52px 0 24px; }
.eyebrow-muted { color: #8a958c; }
.home-section-heading h2 { margin: 10px 0 0; color: var(--em-forest-dark); font: 500 47px/1.1 Manrope, sans-serif; letter-spacing: -2.2px; }
.home-section-heading p { margin: 0 0 9px; color: #78857d; font: italic 14px Georgia, serif; }
.clickable-card { cursor: pointer; }
.clickable-card .v-card-text { color: var(--em-muted); }
.clickable-card .v-avatar { border-radius: 12px !important; }
.home-section-heading + .v-row .v-card { min-height: 185px; }

/* Catalogue screens */
.university-banner { position: relative; display: flex; min-height: 132px; align-items: center; overflow: hidden; padding: 24px; background: linear-gradient(120deg, #e9eee5, #f4e9de); }
.university-banner::after { position: absolute; right: 24px; bottom: -47px; width: 155px; height: 155px; border: 1px solid rgba(33, 77, 59, .18); border-radius: 50%; content: ''; box-shadow: 0 0 0 18px rgba(255,255,255,.13), 0 0 0 38px rgba(255,255,255,.12); }
.university-banner .v-avatar { z-index: 1; }
.program-art { min-height: 100px; background: linear-gradient(135deg, #edf1e8, #f3e5d9) !important; }
.program-art .v-icon { color: var(--em-forest) !important; }
.program-card, .clickable-card { transition: transform .18s ease, box-shadow .18s ease; }
.program-card:hover, .clickable-card:hover { transform: translateY(-3px); box-shadow: 0 14px 30px rgba(24, 48, 34, .09) !important; }
.program-card h3 { color: var(--em-forest-dark); }
.detail-banner { color: #fff; background: radial-gradient(circle at 82% 18%, rgba(205, 126, 89, .3), transparent 24%), linear-gradient(120deg, #183c2e, #315e48); }
.detail-banner .v-chip { color: #f3d6c5 !important; border-color: #86a08d !important; }
.metric-label { margin-bottom: 5px; color: #88948b; font-size: .72rem; font-weight: 700; letter-spacing: .8px; text-transform: uppercase; }
.v-card .text-medium-emphasis { color: var(--em-muted) !important; }
.v-pagination__item--is-active .v-btn { color: white !important; background: var(--em-forest) !important; }

@media (max-width: 960px) {
  .hero-panel { min-height: 590px; padding-right: 5%; padding-left: 5%; }
  .hero-panel h1 { font-size: clamp(50px, 7.5vw, 70px); }
  .hero-art { transform: scale(.88); transform-origin: center right; margin-right: -20px; }
  .hero-search-wrap, .hero-bottom { right: 5%; left: 5%; }
  .hero-search-wrap { gap: 16px; }
  .hero-search-copy { min-width: 145px; }
}
@media (max-width: 600px) {
  .v-main .v-container { padding: 20px 16px 48px !important; }
  .hero-panel { display: block; min-height: 680px; padding: 40px 23px 155px; }
  .hero-panel h1 { margin: 18px 0; font-size: clamp(48px, 13vw, 64px); letter-spacing: -3.4px; }
  .hero-copy { max-width: 340px; font-size: 13px; }
  .hero-note { margin-top: 19px; font-size: 11px; }
  .hero-art { position: absolute; top: 286px; right: -3%; width: 100%; height: 290px; transform: scale(.8); transform-origin: top right; }
  .sun-disc { width: 215px; height: 215px; }
  .arch { left: 31%; width: 165px; height: 208px; }
  .arch-window { left: 26px; width: 113px; height: 155px; }
  .person { left: 44%; transform: scale(.84); transform-origin: bottom left; }
  .hero-search-wrap { right: 20px; bottom: 43px; left: 20px; display: block; }
  .hero-search-copy { margin-bottom: 8px; }
  .hero-search-copy small { display: none; }
  .hero-search-row .v-field__input { min-height: 52px; }
  .hero-search-row .search-button { padding: 0 10px; font-size: 0; }
  .hero-search-row .search-button .v-icon { margin: 0 !important; font-size: 20px; }
  .hero-bottom { right: 20px; left: 20px; height: 29px; font-size: 7px; }
  .home-section-heading { display: block; margin: 39px 0 19px; }
  .home-section-heading h2 { font-size: 39px; }
  .home-section-heading p { margin-top: 8px; font-size: 12px; }
  .page-intro { margin-bottom: 20px; }
  .page-intro h1 { font-size: 31px; }
  .university-banner { min-height: 105px; }
  .detail-banner { padding: 24px !important; }
  .detail-banner h1 { font-size: 30px !important; }
}
@media (prefers-reduced-motion: reduce) { .program-card, .clickable-card { transition: none; } }
</style>
